<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

/**
 * Automatically scopes queries to the authenticated user and sets user_id on create.
 * For models where user_id is required (NOT NULL).
 */
trait BelongsToUser
{
    protected static function bootBelongsToUser(): void
    {
        static::addGlobalScope('user', function (Builder $query) {
            if (auth()->hasUser()) {
                $table = $query->getModel()->getTable();
                $query->where("{$table}.user_id", auth()->id());
            }
        });

        static::creating(function (self $model) {
            if (auth()->hasUser()) {
                $model->user_id ??= auth()->id();
            }
        });
    }
}
