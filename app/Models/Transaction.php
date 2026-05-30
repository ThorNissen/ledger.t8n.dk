<?php

namespace App\Models;

use App\Enums\TransactionDirectionEnum;
use App\Models\Concerns\BelongsToUser;
use Database\Factories\TransactionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    /** @use HasFactory<TransactionFactory> */
    use BelongsToUser, HasFactory;

    protected $fillable = [
        'user_id',
        'account_id',
        'transaction_type_id',
        'date',
        'description',
        'amount',
        'direction',
        'notes',
        'external_id',
        'meta',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'amount' => 'decimal:2',
            'direction' => TransactionDirectionEnum::class,
            'meta' => 'array',
        ];
    }
}
