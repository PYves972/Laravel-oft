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
        'start_at',
        'end_at',
        'capacity_max',
        'status',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'capacity_max' => 'integer',
    ];

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function confirmedBookingsCount(): int
    {
        return $this->bookings()
            ->where('status', 'confirmed')
            ->count();
    }

    public function remainingSeats(): int
    {
        return max(
            0,
            $this->capacity_max - $this->confirmedBookingsCount()
        );
    }

    public function hasAvailableSeats(): bool
    {
        return $this->remainingSeats() > 0;
    }

    public function isFull(): bool
    {
        return !$this->hasAvailableSeats();
    }
}
