<?php

namespace App\Models;

use App\Models\Concerns\BelongsToUser;
use Database\Factories\ImportFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Import extends Model
{
    /** @use HasFactory<ImportFactory> */
    use BelongsToUser, HasFactory;

    protected $fillable = [
        'user_id',
        'filename',
        'rows_imported',
        'imported_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'imported_at' => 'datetime',
            'rows_imported' => 'integer',
        ];
    }
}
