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
        'color',
        'description',
        'duration_minutes',
        'price',
        'is_active',
         'image_path',
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
