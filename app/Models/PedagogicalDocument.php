<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PedagogicalDocument extends Model
{
    protected $fillable = [
        'training_id',
        'title',
        'file_path',
        'is_public',
    ];

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }
}
