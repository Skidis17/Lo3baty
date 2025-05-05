<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Objet;
use Carbon\Carbon;

class AnnonceDetailsController extends Controller
{
    public function show($id)
{
   
    $objet = Objet::with('proprietaire')->findOrFail($id);
    
    return view('client.details_annonce', compact('objet'));
}

}