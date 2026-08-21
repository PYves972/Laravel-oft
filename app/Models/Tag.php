<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    /**
     * Un tag peut appartenir à plusieurs formations.
     */
public function trainings(): BelongsToMany
{
    return $this->belongsToMany(Training::class, 'training_tag');
}
}
