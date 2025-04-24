<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\Evaluation;

class UtilisateurController extends Controller
{public function show($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $commentaires = Evaluation::where('evalue_id', $id)
            ->with(['evaluateur', 'objet'])
            ->get();
    
        return view('client.show', [
            'utilisateur' => $utilisateur,
            'commentaires' => $commentaires
        ]);
    }
}