<?php

namespace App\Models;

use Database\Factories\TransactionTypeFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionType extends Model
{
    /** @use HasFactory<TransactionTypeFactory> */
    use HasFactory;

    protected static function booted(): void
    {
        // Show system types (user_id null) plus the user's own types.
        static::addGlobalScope('user', function (Builder $query) {
            if (auth()->hasUser()) {
                $query->where(function (Builder $q) {
                    $q->whereNull('user_id')->orWhere('user_id', auth()->id());
                });
            }
        });

        static::creating(function (self $model) {
            if (auth()->hasUser()) {
                $model->user_id ??= auth()->id();
            }
        });
    }

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'is_system',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function rules(): HasMany
    {
        return $this->hasMany(Rule::class);
    }

    protected function casts(): array
    {
        return [
            'is_system' => 'boolean',
        ];
    }
}
