<?php

namespace App\Services;

use App\Models\Rule;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Support\DescriptionNormalizer;

class RuleMatcherService
{
    public function match(Transaction $transaction): ?TransactionType
    {
        $normalized = DescriptionNormalizer::normalize($transaction->description);

        $rules = Rule::where('user_id', $transaction->user_id)
            ->where('is_enabled', true)
            ->orderBy('priority')
            ->get();

        foreach ($rules as $rule) {
            $keyword = $rule->case_sensitive
                ? $rule->keyword
                : mb_strtolower($rule->keyword);

            $haystack = $rule->case_sensitive
                ? $transaction->description
                : $normalized;

            if (str_contains($haystack, $keyword)) {
                return $rule->transactionType;
            }
        }

        return null;
    }
}
