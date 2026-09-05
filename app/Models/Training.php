<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str; // <-- AJOUTER CETTE LIGNE

class Training extends Model
{
    protected $fillable = [
    'category_id',
    'title',
    'slug',
    'price',
    'duration_minutes',
    'description',
    'image_path',
    'gallery_images',
    'prerequisites',
    'provided_equipment',
    'required_equipment',
    'program_steps',
    'is_active',
];

protected $casts = [
    'gallery_images' => 'array',
    'program_steps' => 'array',
    'is_active' => 'boolean',
];

    protected static function booted(): void
    {
        static::creating(function (Training $training) {
            if (empty($training->slug)) {
                $training->slug = Str::slug($training->title);
            }
        });

        static::updating(function (Training $training) {
            if ($training->isDirty('title') && empty($training->slug)) {
                $training->slug = Str::slug($training->title);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
