<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // Import explicite du modèle User

class PartenaireController extends Controller
{
    public function showContrat()
    {
        if (Auth::user()->role !== 'client') {
            return redirect()->route('home')
                           ->with('error', 'Vous êtes déjà partenaire.');
        }
        
        return view('partenaire.contrat');
    }
    public function devenirPartenaire(Request $request)
    {
        $validated = $request->validate([
            'cin_recto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'cin_verso' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'terms' => 'required|accepted'
        ]);
    
        /** @var \App\Models\User $user */
        $user = Auth::user();
    
        if ($user->role === 'propriétaire') {
            return redirect()->route('home')
                           ->with('error', 'Vous êtes déjà partenaire.');
        }
    
        // Stockage des fichiers
        $rectoPath = $request->file('cin_recto')->store('cins', 'public');
        $versoPath = $request->file('cin_verso')->store('cins', 'public');
    
        // Mise à jour de l'utilisateur
        $user->cin_recto = $rectoPath;
        $user->cin_verso = $versoPath;
        $user->role = 'propriétaire';
        
        if (!$user->save()) {
            return back()->with('error', 'Une erreur est survenue lors de la mise à jour.');
        }
    
        return redirect()->route('home')
                       ->with('success', 'Félicitations ! Vous êtes maintenant partenaire.');
    }
    
    
    

    // Assure-toi que tu as bien ce use en haut du contrôleur

    public function switchRole(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
    
        if ($request->input('role') === 'propriétaire') {
            // Si l'utilisateur est déjà partenaire
            if ($user->role === 'propriétaire') {
                return response()->json([
                    'success' => true,
                    'redirect' => route('partenaire.home')
                ]);
            }
            
            // Si l'utilisateur est client mais n'a pas complété les documents
            if (!$user->cin_recto || !$user->cin_verso) {
                return response()->json([
                    'redirect' => route('partenaire.contrat'),
                    'completed' => false
                ]);
            }
            
            // Si client valide veut devenir partenaire
            $user->role = 'propriétaire';
            $user->save();
            
            return response()->json([
                'success' => true,
                'redirect' => route('partenaire.home')
            ]);
        }
        elseif ($request->input('role') === 'client') {
            // Même si c'est un partenaire, on le laisse voir l'interface client
            return response()->json([
                'success' => true,
                'redirect' => route('client.acceuil')
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Action non autorisée'
        ]);
    }
}
