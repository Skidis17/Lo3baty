<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'annonce_id' => 'required|exists:annonces,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $annonce = Annonce::findOrFail($request->annonce_id);

        if (!$annonce->isAvailable($request->date_debut, $request->date_fin)) {
            return back()->with('error', 'Cette période est déjà réservée. Veuillez choisir d\'autres dates.');
        }

        $reservation = Reservation::create([
            'client_id' => Auth::id(),
            'annonce_id' => $request->annonce_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'statut' => 'en attente',
        ]);

        return back()->with('success', 'Votre demande de réservation a été envoyée avec succès.');
    }
}