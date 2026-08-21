<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Une catégorie contient plusieurs formations (RM-06).
     */
    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class);
    }
}
