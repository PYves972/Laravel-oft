<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Training extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'type',
        'price',
        'duration_minutes',
        'is_active',
        'description',
        'image_path',
        'gallery_images',
        'prerequisites',
        'provided_equipment',
        'required_equipment',
        'program_steps',
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

    public function sessions(): HasMany
    {
        return $this->hasMany(TrainingSession::class);
    }

    public function pedagogicalDocuments(): HasMany
    {
        return $this->hasMany(PedagogicalDocument::class);
    }
public function documents(): \Illuminate\Database\Eloquent\Relations\HasMany
{
    return $this->hasMany(\App\Models\PedagogicalDocument::class);
}
    public function progressions(): HasMany
{
    return $this->hasMany(Progression::class);
}
}
