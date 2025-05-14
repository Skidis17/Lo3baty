<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaiementClient;
use App\Models\Annonce;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    public function show()
    {
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        // Récupérer les données de réservation depuis la session
        $reservationData = session()->get('pending_reservation');
        
        if (!$reservationData) {
            return redirect()->back()->with('error', 'Aucune réservation en attente.');
        }

        // Vérifier que la réservation appartient à l'utilisateur
        if ($reservationData['client_id'] != $user->id) {
            return redirect()->back()->with('error', 'Action non autorisée.');
        }

        // Créer un objet Reservation factice pour la vue
        $reservation = new Reservation($reservationData);
        
        // Charger l'annonce avec vérification
        $annonce = Annonce::findOrFail($reservationData['annonce_id']);
        $reservation->setRelation('annonce', $annonce);

        return view('client.paiement', compact('reservation'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'methode' => 'required|in:paypal,especes,carte',
            'livraison' => 'required|boolean',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        // Récupérer les données de réservation depuis la session
        $reservationData = session()->get('pending_reservation');
        
        if (!$reservationData) {
            return redirect()->back()->with('error', 'Aucune réservation en attente.');
        }

        // Vérifier que la réservation appartient à l'utilisateur
        if ($reservationData['client_id'] != $user->id) {
            return redirect()->back()->with('error', 'Action non autorisée.');
        }

        try {
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
                'etat' => 'en_attente', // ou 'completé' selon votre logique
                'livraison' => $request->livraison,
                'montant_livraison' => $deliveryAmount,
            ]);

            // Nettoyer la session
            session()->forget('pending_reservation');

            // Rediriger vers une page de confirmation
            return redirect()->route('annonces')->with('success', 'Paiement effectué avec succès !');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors du traitement de votre paiement.')
                ->withInput();
        }
    }
}