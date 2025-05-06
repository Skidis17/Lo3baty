<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;


class ReservationHistoriqueController extends Controller
{
    public function reservations()
    {
        $clientId = 2; // Replace with auth()->id() later
        $statuses = ['En attente', 'Acceptée', 'Passé'];
    
        $reservations = Reservation::with([
            'annonce.proprietaire.evaluationsPartenaire', // Eager load relationships
            'annonce.objet.images',
            'evaluationOnPartner'
        ])
        ->where('client_id', $clientId)
        ->get();
    
        return view('client.reservations', [
            'reservations' => $reservations,
            'counts' => $this->calculateStatusCounts($clientId, $statuses)
        ]);
    }
    
    private function calculateStatusCounts($clientId, $statuses)
    {
        return Reservation::where('client_id', $clientId)
            ->selectRaw('statut, count(*) as count')
            ->groupBy('statut')
            ->get()
            ->keyBy('statut')
            ->map(fn($item) => $item->count);
    }
}
