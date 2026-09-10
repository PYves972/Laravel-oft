<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Progression extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'training_id',
        'percentage',
        'notes',
        'is_completed',
    ];

    protected function casts(): array
    {
        return [
            'percentage'   => 'integer',
            'is_completed' => 'boolean',
        ];
    }

    /**
     * Gestion automatique de la règle RM-36 à la création/mise à jour.
     */
    protected static function booted(): void
    {
        static::saving(function (Progression $progression) {
            // S'assure que le pourcentage reste strict entre 0 et 100
            $progression->percentage = min(100, max(0, $progression->percentage));

            // RM-36 : Marque comme terminée si la progression atteint 100%
            $progression->is_completed = ($progression->percentage === 100);
        });
    }

    /**
     * L'apprenant concerné par la progression (RM-34).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * La formation associée (RM-34).
     */
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }
}
