<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objet;
use Illuminate\Support\Facades\DB;

class AnnonceController extends Controller
{
    public function index(Request $request)
    {
        $query = Objet::query()
            ->with('annonces')
            ->leftJoin('annonces', 'objets.id', '=', 'annonces.objet_id')
            ->select('objets.*'); // ensure only objet columns are selected to avoid conflicts
    
        if ($request->filled('search')) {
            $query->where('objets.nom', 'like', '%' . $request->search . '%');
        }
    
        if ($request->has('ages')) {
            $query->whereIn('objets.tranche_age', $request->ages); 
        }
    
        if ($request->has('prices')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->prices as $price) {
                    if ($price == '150+') {
                        $q->orWhere('annonces.prix_journalier', '>', 150);
                    } else {
                        [$min, $max] = explode('-', $price);
                        $q->orWhereBetween('annonces.prix_journalier', [(int) $min, (int) $max]);
                    }
                }
            });
        }
    
        if ($request->has('types')) {
            $query->whereIn('objets.type', $request->types); 
        }
    
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('annonces.prix_journalier', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('annonces.prix_journalier', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('objets.created_at', 'desc');
                    break;
            }
        }
    
        $objets = $query->paginate(9);
    
        return view('client.annonces', compact('objets'));
    }
    

  
}




?>