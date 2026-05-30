<?php

namespace App\Models;

use App\Models\Concerns\BelongsToUser;
use Database\Factories\RuleSuggestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RuleSuggestion extends Model
{
    /** @use HasFactory<RuleSuggestionFactory> */
    use BelongsToUser, HasFactory;

    protected $fillable = [
        'user_id',
        'pattern',
        'occurrences',
        'suggested_transaction_type_id',
        'is_reviewed',
        'is_accepted',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function suggestedTransactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class, 'suggested_transaction_type_id');
    }

    protected function casts(): array
    {
        return [
            'occurrences' => 'integer',
            'is_reviewed' => 'boolean',
            'is_accepted' => 'boolean',
        ];
    }
}
