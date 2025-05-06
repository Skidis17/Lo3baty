<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\EvaluationOnAnnonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function create(Reservation $reservation)
    {
        return view('evaluations.create', [
            'reservation' => $reservation,
            'annonce' => $reservation->annonce
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'note' => 'required|integer|between:1,5',
            'commentaire' => 'required|string|max:500',
            'objet_id' => 'required|exists:objets,id',
            'client_id' => 'required|exists:utilisateurs,id'
        ]);

        // Verify client is submitting for themselves
        if ($validated['client_id'] != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if evaluation already exists
        $exists = EvaluationOnAnnonce::where('objet_id', $validated['objet_id'])
                                    ->where('client_id', $validated['client_id'])
                                    ->exists();

        if ($exists) {
            return back()->withErrors(['error' => 'Vous avez déjà évalué cette annonce']);
        }

        EvaluationOnAnnonce::create($validated);

        return redirect()->route('home')->with('success', 'Merci pour votre évaluation !');
    }
}