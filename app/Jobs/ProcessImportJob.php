<?php

namespace App\Jobs;

use App\Models\Account;
use App\Services\TransactionImportService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessImportJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public array $backoff = [1, 5, 10];

    /** @param array<string, string> $columnMap */
    public function __construct(
        public readonly string $filePath,
        public readonly int $accountId,
        public readonly array $columnMap = [],
    ) {}

    public function handle(TransactionImportService $importer): void
    {
        $account = Account::findOrFail($this->accountId);

        $importer->importFromCsv($this->filePath, $account, $this->columnMap);

        if (file_exists($this->filePath)) {
            unlink($this->filePath);
        }
    }
}
