<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objet;
use Illuminate\Support\Facades\DB;

class AnnonceController extends Controller
{
    public function index(Request $request)
    {
        $query = Objet::query();

        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        if ($request->has('ages')) {
            $query->whereIn('tranche_age', $request->ages); 
        }

        if ($request->has('prices')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->prices as $price) {
                    if ($price == '150+') {
                        $q->orWhere('prix', '>', 150);
                    } else {
                        [$min, $max] = explode('-', $price);
                        $q->orWhereBetween('prix', [(int) $min, (int) $max]);
                    }
                }
            });
        }

        if ($request->has('types')) {
            $query->whereIn('type', $request->types); 
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('prix', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('prix', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }

        $objets = $query->paginate(9);

        return view('client.annonces', compact('objets'));
    }

  
}




?>