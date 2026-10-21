<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'sujet',
        'niveau',
        'message',
        'fichier_path',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];
}
