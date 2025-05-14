<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class Partenaire_clientController extends Controller
{
    // Affichage des partenaires
    public function indexPartenaires(Request $request)
    {
        $query = Utilisateur::where('role', 'partenaire');
    
        // Filtrer par surnom
        if ($request->filled('surnom')) {
            $query->where('surnom', 'like', '%' . $request->surnom . '%');
        }
    
        // Filtrer par is_active actif/inactif
        if ($request->statut === 'actif') {
            $query->where('is_active', true);
        } elseif ($request->statut === 'inactif') {
            $query->where('is_active', false);
        }
    
        // Récupération paginée avec les filtres
        $partenaires = $query->orderBy('created_at', 'desc')->paginate(10);
    
        // Ajouter les filtres dans la pagination
        return view('admin.partenaires.index', compact('partenaires'));
    }
    

    // Affichage des clients
     // Affichage des clients avec filtrage
     public function indexClients(Request $request)
     {
         // Définir la requête de base pour les clients
         $query = Utilisateur::where('role', 'client');
     
         // Filtrer par surnom
         if ($request->filled('surnom')) {
             $query->where('surnom', 'like', '%' . $request->surnom . '%');
         }
     
         // Filtrer par statut actif/inactif
         if ($request->statut === 'actif') {
             $query->where('is_active', true);
         } elseif ($request->statut === 'inactif') {
             $query->where('is_active', false);
         }
     
         // Récupérer les clients avec pagination
         $clients = $query->orderBy('created_at', 'desc')->paginate(10);
     
         // Passer les résultats à la vue
         return view('admin.clients.index', compact('clients'));
     }

    // Toggle status pour les partenaires
    public function toggleStatusPartenaire(Utilisateur $partenaire)
    {
        $partenaire->isActive() ? $partenaire->deactivate() : $partenaire->activate();

        return back()->with(
            'success',
            $partenaire->isActive() 
                ? 'Compte activé avec succès' 
                : 'Compte désactivé avec succès'
        );
    }

    // Toggle status pour les clients
    public function toggleStatusClient(Utilisateur $client)
    {
        $client->isActive() ? $client->deactivate() : $client->activate();

        return back()->with(
            'success',
            $client->isActive() 
                ? 'Compte activé avec succès'
                : 'Compte désactivé avec succès'
        );
    }

    
}
