<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionCategorizerService
{
    public function __construct(private readonly RuleMatcherService $matcher) {}

    public function categorizeUncategorized(int $userId): int
    {
        $categorized = 0;

        Transaction::where('user_id', $userId)
            ->whereNull('transaction_type_id')
            ->chunkById(100, function ($transactions) use (&$categorized) {
                foreach ($transactions as $transaction) {
                    $type = $this->matcher->match($transaction);

                    if ($type) {
                        $transaction->update(['transaction_type_id' => $type->id]);
                        $categorized++;
                    }
                }
            });

        return $categorized;
    }
}
