<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Property;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Enregistre un nouveau commentaire.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'property_id' => 'required|exists:properties,id',
        ]);

        Comment::create([
            'content' => $request->content,
            'property_id' => $request->property_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('properties.show', $request->property_id)
                         ->with('success', 'Commentaire ajouté avec succès.');
    }

    /**
     * Supprime un commentaire (admin uniquement).
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Commentaire supprimé avec succès.');
    }
}

