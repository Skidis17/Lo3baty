<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request, Annonce $annonce)
    {
        $request->validate([
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut'
        ]);

        // Vérifier les conflits de dates
        $existingReservation = Reservation::where('annonce_id', $annonce->id)
            ->where(function($query) use ($request) {
                $query->whereBetween('date_debut', [$request->date_debut, $request->date_fin])
                      ->orWhereBetween('date_fin', [$request->date_debut, $request->date_fin])
                      ->orWhere(function($query) use ($request) {
                          $query->where('date_debut', '<=', $request->date_debut)
                                ->where('date_fin', '>=', $request->date_fin);
                      });
            })
            ->exists();

        if ($existingReservation) {
            return back()->withErrors(['date' => 'Ces dates ne sont pas disponibles']);
        }

        Reservation::create([
            'client_id' => Auth::id(),
            'annonce_id' => $annonce->id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'statut' => 'en attente'
        ]);

        return redirect()->back()->with('success', 'Votre demande de réservation a été envoyée');
    }
}