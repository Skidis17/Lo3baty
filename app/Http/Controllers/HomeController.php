<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objet;
use App\Models\EvaluationOnAnnonce;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
 

public function index()
{
    $user = Auth::user();
    
    if ($user->role === 'propriétaire') {
        return view('partenaire.home');
    }
    
    return view('client.acceuil');
}


public function partenaireHome()
{
    if (Auth::user()->role !== 'propriétaire') {
        return redirect()->route('client.acceuil');
    }
    
    return view('partenaire.acceuil');
}

  public function clientHome()
    {
        $objets = Objet::with(['images', 'annonces'])->get(); // Get objects with relations

        $testimonials = EvaluationOnAnnonce::with(['client', 'objet'])
        ->where('note', '>=', 4) 
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

        return view('client.acceuil', ['objet' => $objets], ['testimonials'=> $testimonials]); // Pass data to view
    }
}