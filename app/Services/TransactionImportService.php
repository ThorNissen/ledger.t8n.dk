<?php

namespace App\Services;

use App\Enums\TransactionDirectionEnum;
use App\Jobs\CategorizeTransactionsJob;
use App\Jobs\GenerateRuleSuggestionsJob;
use App\Models\Account;
use App\Models\Import;
use App\Models\Transaction;
use App\Support\CsvHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionImportService
{
    /**
     * @param  array<string, string>  $columnMap  Maps CSV headers to transaction fields.
     */
    public function importFromCsv(string $filePath, Account $account, array $columnMap = []): Import
    {
        $userId = $account->user_id;
        $imported = 0;

        DB::transaction(function () use ($filePath, $account, $columnMap, $userId, &$imported) {
            $delimiter = CsvHelper::detectDelimiter($filePath);
            $handle = fopen($filePath, 'r');
            $headers = fgetcsv($handle, 0, $delimiter);

            if ($headers === false) {
                fclose($handle);

                return;
            }

            $headers = array_map(fn (string $h) => trim($h, " \t\n\r\0\x0B\xEF\xBB\xBF"), $headers);

            while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
                $data = array_combine($headers, $row);

                if ($data === false) {
                    continue;
                }

                $mapped = $this->mapRow($data, $columnMap);

                if (empty($mapped['description']) || empty($mapped['amount'])) {
                    continue;
                }

                $amount = (float) str_replace([',', ' '], ['.', ''], $mapped['amount']);
                $direction = $amount < 0 ? TransactionDirectionEnum::Expense : TransactionDirectionEnum::Income;

                $transaction = Transaction::firstOrCreate(
                    [
                        'user_id' => $userId,
                        'external_id' => $mapped['external_id'] ?? null,
                        'date' => Carbon::parse($mapped['date'] ?? now()),
                        'description' => $mapped['description'],
                        'amount' => abs($amount),
                    ],
                    [
                        'account_id' => $account->id,
                        'direction' => $direction,
                        'meta' => $mapped['meta'] ?? null,
                    ]
                );

                if ($transaction->wasRecentlyCreated) {
                    $imported++;
                }
            }

            fclose($handle);
        });

        $import = Import::create([
            'user_id' => $userId,
            'filename' => basename($filePath),
            'rows_imported' => $imported,
            'imported_at' => now(),
        ]);

        CategorizeTransactionsJob::dispatch($userId);
        GenerateRuleSuggestionsJob::dispatch($userId);

        return $import;
    }

    /** @param array<string, string> $columnMap */
    private function mapRow(array $data, array $columnMap): array
    {
        if (empty($columnMap)) {
            return $data;
        }

        $mapped = [];

        foreach ($columnMap as $field => $csvHeader) {
            $mapped[$field] = $data[$csvHeader] ?? null;
        }

        return $mapped;
    }
}
