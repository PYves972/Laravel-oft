<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'start_at',
        'end_at',
        'capacity_max',
        'status',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    /**
     * Chaque séance est rattachée à une seule formation (RM-17).
     */
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }
}
