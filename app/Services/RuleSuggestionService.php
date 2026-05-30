<?php

namespace App\Services;

use App\Models\RuleSuggestion;
use App\Models\Transaction;
use App\Support\DescriptionNormalizer;

class RuleSuggestionService
{
    /** Minimum occurrences before generating a suggestion. */
    private const int OCCURRENCE_THRESHOLD = 3;

    public function generateSuggestions(int $userId): void
    {
        $patterns = [];

        Transaction::where('user_id', $userId)
            ->whereNull('transaction_type_id')
            ->cursor()
            ->each(function (Transaction $transaction) use (&$patterns) {
                $key = DescriptionNormalizer::normalize($transaction->description);

                if (! isset($patterns[$key])) {
                    $patterns[$key] = 0;
                }

                $patterns[$key]++;
            });

        foreach ($patterns as $pattern => $occurrences) {
            if ($occurrences < self::OCCURRENCE_THRESHOLD) {
                continue;
            }

            RuleSuggestion::updateOrCreate(
                ['user_id' => $userId, 'pattern' => $pattern],
                ['occurrences' => $occurrences]
            );
        }
    }
}
