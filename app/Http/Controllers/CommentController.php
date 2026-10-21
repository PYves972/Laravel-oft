<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Enregistre un commentaire : il est créé « en attente » et ne devient
     * public qu'après modération dans l'administration.
     */
    public function store(StoreCommentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Comment::create([
            'user_id'     => Auth::id(),
            'training_id' => $validated['training_id'],
            'content'     => $validated['content'],
            'rating'      => $validated['rating'],
            'status'      => 'pending',
        ]);

        return back()->with('success', 'Votre commentaire a été soumis et est en attente de modération.');
    }
}
