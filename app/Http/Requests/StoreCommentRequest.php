<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCommentRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        // Seuls les utilisateurs authentifiés peuvent poster un commentaire
        return Auth::check();
    }

    /**
     * Obtenir les règles de validation qui s'appliquent à la requête.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'training_id' => ['required', 'exists:trainings,id'],
            'content'     => ['required', 'string', 'min:5', 'max:1000'],
            'rating'      => ['required', 'integer', 'min:1', 'max:5'],
        ];
    }

    /**
     * Obtenir les messages de validation personnalisés.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'training_id.required' => 'La formation concernée est obligatoire.',
            'training_id.exists'   => 'La formation sélectionnée n\'existe pas.',
            'content.required'     => 'Le contenu du commentaire ne peut pas être vide.',
            'content.min'          => 'Votre commentaire doit contenir au moins 5 caractères.',
            'content.max'          => 'Votre commentaire ne peut pas dépasser 1000 caractères.',
            'rating.required'      => 'La note est obligatoire.',
            'rating.integer'       => 'La note doit être un nombre entier.',
            'rating.min'           => 'La note minimale est de 1.',
            'rating.max'           => 'La note maximale est de 5.',
        ];
    }
}
