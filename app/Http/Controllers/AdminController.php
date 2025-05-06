<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Evaluation;
use App\Models\Utilisateur;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
  public function dashboard()
  {
    $partnerCount = Utilisateur::where('role', 'propriétaire')->count();
    $clientCount = Utilisateur::where('role', 'client')->count();
    $annonceCount = Annonce::count();
    $totalRevenue = DB::table('reservation')
      ->join('annonce', 'reservation.annonce_id', '=', 'annonce.id')
      ->join('objet', 'annonce.objet_id', '=', 'objet.id')
      ->sum(DB::raw('objet.prix_journalier * DATEDIFF(reservation.date_fin, reservation.date_debut)'));

    $latestAnnonces = Annonce::with('proprietaire', 'objet')->latest()->take(5)->get();
    $newPartners = Utilisateur::where('role', 'propriétaire')->withCount('annonces')->latest()->take(5)->get();
    $messages = Notification::with('utilisateur')->latest()->take(5)->get();
    $evaluations = Evaluation::with('objet', 'evaluateur')->latest()->take(5)->get();

    return view('admin.dashboard', compact('partnerCount', 'clientCount', 'annonceCount', 'totalRevenue', 'latestAnnonces', 'newPartners', 'messages', 'evaluations'));
  }
}