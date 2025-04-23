<?php

namespace App\Http\Controllers\Partner\Product;

use App\Http\Controllers\Controller;
use App\Models\Objet;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Objet::where('proprietaire_id', 1)->with('categorie')->get();
        return view('partner.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('partner.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ville' => 'required|string|max:255',
            'prix_journalier' => 'required|numeric',
            'etat' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        Objet::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'ville' => $request->ville,
            'prix_journalier' => $request->prix_journalier,
            'etat' => $request->etat,
            'categorie_id' => $request->categorie_id,
            'proprietaire_id' => 1,
        ]);

        return redirect()->route('partner.products.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function edit(Objet $product)
    {
        //$this->authorize('update', $product); // Optional if using policies
        $categories = Categorie::all();
        return view('partner.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Objet $product)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ville' => 'required|string|max:255',
            'prix_journalier' => 'required|numeric',
            'etat' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->only([
            'nom', 'description', 'ville', 'prix_journalier', 'etat', 'categorie_id'
        ]));

        return redirect()->route('partner.products.index')->with('success', 'Produit modifié avec succès.');
    }

    public function destroy(Objet $product)
    {
        //$this->authorize('delete', $product); // Optional if using policies
        $product->delete();
        return redirect()->route('partner.products.index')->with('success', 'Produit supprimé avec succès.');
    }
}
