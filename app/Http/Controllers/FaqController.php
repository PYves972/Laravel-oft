<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __invoke(Request $request)
    {
        $faqs = [
            [
                'category' => 'Déroulement des ateliers',
                'items' => [
                    [
                        'question' => "Faut-il apporter son propre matériel ?",
                        'answer' => "Tout le matériel de base (machines à coudre, fils, aiguilles, pigments) est entièrement fourni sur place. Vous repartirez directement avec votre création !"
                    ],
                    [
                        'question' => "Je n'ai jamais pratiqué, puis-je venir ?",
                        'answer' => "Absolument ! Nos ateliers sont accessibles aux grands débutants. Vous serez guidé(e) pas à pas dans une ambiance conviviale."
                    ],
                ]
            ],
            [
                'category' => 'Réservation & Annulation',
                'items' => [
                    [
                        'question' => "Comment annuler ou modifier une réservation ?",
                        'answer' => "Vous pouvez gérer vos réservations depuis votre espace personnel. Les annulations sont acceptées sans frais jusqu'à 48h avant la séance."
                    ],
                    [
                        'question' => "Proposez-vous des cartes cadeaux ?",
                        'answer' => "Oui, vous pouvez acheter un bon cadeau valable sur l'ensemble de nos ateliers depuis la section dédiée."
                    ],
                ]
            ]
        ];

        return view('faq.index', compact('faqs'));
    }
}
