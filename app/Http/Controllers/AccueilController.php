<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objet;
use App\Models\Annonce;
use App\Models\Reservation;

class AccueilController extends Controller
{
    
    public function index()
    {
    $objet = Objet::with('images')->get();
    return view('client/acceuil', compact('objet'));

    }

    public function annonces()
    {
    $annonces = Annonce::all(); 
    return view('client/annonces', compact('annonces'));
    }

    public function annonceById($id)
    {
    $annonce = Annonce::findOrFail($id); 
    return view('annonce', compact('annonce'));
    }


    public function reservations()
    {
    $reservations = Reservation::all(); 
    return view('client/reservations', compact('reservations'));
    }

    
    // public function objet() 
    // {
    //     $objets = Objet::all(); 
    //     return view('acceuil', compact('objets')); 
    // }

}
