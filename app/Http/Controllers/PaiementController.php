<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaiementClient;
use App\Models\Annonce;
use App\Models\Reservation;

class PaiementController extends Controller
{
    // ID client temporaire pour développement
    protected $tempClientId = 1;

    public function show()
{
    // Récupérer les données de réservation depuis la session
    $reservationData = session()->get('pending_reservation');
    
    if (!$reservationData) {
        return redirect()->back()->with('error', 'Aucune réservation en attente.');
    }

    // Créer un objet Reservation factice pour la vue (non sauvegardé en base)
    $reservation = new Reservation($reservationData);
    
    // Charger la relation annonce manuellement
    $reservation->setRelation('annonce', Annonce::find($reservationData['annonce_id']));

    return view('client.paiement', compact('reservation'));
}

public function process(Request $request)
{
    $request->validate([
        'methode' => 'required|in:paypal,especes,carte',
        'livraison' => 'required|boolean',
    ]);

    // Récupérer les données de réservation depuis la session
    $reservationData = session()->get('pending_reservation');
    
    if (!$reservationData) {
        return redirect()->back()->with('error', 'Aucune réservation en attente.');
    }

    // Créer la réservation dans la base de données
    $reservation = Reservation::create($reservationData);
    
    // Calcul du montant
    $days = $reservation->date_debut->diffInDays($reservation->date_fin) + 1;
    $baseAmount = $reservation->annonce->prix_journalier * $days;
    $deliveryAmount = $request->livraison ? $baseAmount * 0.05 : 0;
    $totalAmount = $baseAmount + $deliveryAmount;

    // Enregistrement du paiement
    $paiement = PaiementClient::create([
        'reservation_id' => $reservation->id,
        'client_id' => $reservationData['client_id'],
        'montant' => $totalAmount,
        'methode' => $request->methode,
        'date_paiement' => now(),
        'etat' => 'en_attente',
        'livraison' => $request->livraison,
        'montant_livraison' => $deliveryAmount,
    ]);

    // Nettoyer la session
    session()->forget('pending_reservation');

    // Rediriger vers une page de confirmation
    return redirect()->route('annonces')->with('success', 'Paiement effectué avec succès !');
}
}