<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'learning_objectives',
        'duration_minutes',
        'price',
        'is_active',
    ];

    /**
     * Une formation appartient à une seule catégorie (RM-07).
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Une formation peut être associée à plusieurs tags (RM-12).
     */
  public function tags(): BelongsToMany
{
    return $this->belongsToMany(Tag::class, 'training_tag');
}

    /**
     * Une formation comporte plusieurs séances (RM-13).
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(TrainingSession::class);
    }
}
