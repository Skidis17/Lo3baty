<?php

namespace App\Http\Controllers;

use App\Models\{Reservation, EvaluationOnAnnonce, EvaluationOnPartner};
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function create(Reservation $reservation)
    {
        return view('client.eval_Annonce', [
            'reservation' => $reservation,
            'annonce' => $reservation->annonce,
            'partner' => $reservation->annonce->proprietaire,
            'objet' => $reservation->annonce->objet
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'annonce_note' => 'required|integer|between:1,5',
            'annonce_comment' => 'required|string|max:500',
            'partner_note' => 'required|integer|between:1,5',
            'partner_comment' => 'required|string|max:500',
            'reservation_id' => 'required|exists:reservations,id',
            'objet_id' => 'required|exists:objets,id',
            'partner_id' => 'required|exists:utilisateurs,id',
            'client_id' => 'required|exists:utilisateurs,id'
        ]);

        EvaluationOnAnnonce::create([
            'reservation_id' => $validated['reservation_id'],
            'objet_id' => $validated['objet_id'],
            'client_id' => $validated['client_id'],
            'note' => $validated['annonce_note'],
            'commentaire' => $validated['annonce_comment']
        ]);

        EvaluationOnPartner::create([
            'reservation_id' => $validated['reservation_id'],
            'partner_id' => $validated['partner_id'],
            'client_id' => $validated['client_id'],
            'note' => $validated['partner_note'],
            'commentaire' => $validated['partner_comment']
        ]);

        return back()->with('success', 'Merci pour vos évaluations !');
    }
}