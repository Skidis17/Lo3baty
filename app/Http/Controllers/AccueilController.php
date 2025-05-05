<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Objet;
use App\Models\Annonce;
use App\Models\Reservation;

class AccueilController extends Controller
{
    
    public function index()
    {
        $objet = Objet::with(['images', 'annonces' => function ($query) {
            $query->orderByDesc('premium')
                  ->orderByDesc('date_publication');
        }])
        ->withMax(['annonces as latest_premium_date' => function ($query) {
            $query->where('premium', true);
        }], 'date_publication')
        ->orderByDesc('latest_premium_date')
        ->get();
        return view('client/acceuil', compact('objet'));

    }

    public function annonces()
    {
    $annonces = Annonce::all(); 
    return view('client/annonces', compact('annonces'));
    }

    public function annonceById($id)
    {
    $annonce = Annonce::with('objet', 'objet.images')->findOrFail($id);
    return view('client.annonce', compact('annonce'));
    }


    public function reservations()
    {
        $clientId = 2;
        $statuses = ['en attente', 'acceptée', 'archivee'];
    
        $counts = [];
        foreach ($statuses as $status) {
            $counts[$status] = Reservation::where('client_id', $clientId)
                ->where('statut', $status)
                ->count();
        }
    
        $reservations = Reservation::with([
                'annonce.utilisateur.partnerEvaluations',
                'annonce.objet.images',
                'evaluationOnPartner'
            ])
            ->where('client_id', $clientId)
            ->get();
    
        return view('client.reservations', [
            'reservations' => $reservations,
            'counts' => $counts
        ]);
    }












    }

