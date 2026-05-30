<?php

namespace App\Models;

use App\Models\Concerns\BelongsToUser;
use Database\Factories\RuleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rule extends Model
{
    /** @use HasFactory<RuleFactory> */
    use BelongsToUser, HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_type_id',
        'keyword',
        'priority',
        'case_sensitive',
        'is_enabled',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }

    protected function casts(): array
    {
        return [
            'priority' => 'integer',
            'case_sensitive' => 'boolean',
            'is_enabled' => 'boolean',
        ];
    }
}
