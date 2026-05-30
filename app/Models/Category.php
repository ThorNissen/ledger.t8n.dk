<?php

namespace App\Models;

use App\Enums\CategoryGroupEnum;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory;

    protected static function booted(): void
    {
        // Show system categories (user_id null) plus the user's own categories.
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
        'name',
        'group',
        'sort_order',
        'color',
        'icon',
        'is_system',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactionTypes(): HasMany
    {
        return $this->hasMany(TransactionType::class);
    }

    protected function casts(): array
    {
        return [
            'group' => CategoryGroupEnum::class,
            'is_system' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
