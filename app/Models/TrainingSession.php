<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'starts_at',
        'ends_at',
        'capacity',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at'   => 'datetime',
            'capacity'  => 'integer',
        ];
    }

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Nombre de places encore disponibles pour cette session.
     */
    public function availablePlaces(): int
    {
        $confirmedBookingsCount = $this->bookings()
            ->where('status', 'confirmed')
            ->count();

        return max(0, $this->capacity - $confirmedBookingsCount);
    }

    /**
     * Indique si la session peut recevoir de nouvelles réservations.
     */
    public function isBookable(): bool
    {
        return $this->status === 'open' && $this->availablePlaces() > 0;
    }
}
