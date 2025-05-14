<?php

namespace Database\Seeders;

use App\Models\Objet;
use App\Models\Annonce;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AnnonceSeeder extends Seeder
{
    public function run(): void
    {
        // Insérer un objet avant d'insérer une annonce
        $objet = Objet::firstOrCreate([
            'id' => 1,
            'name' => 'Objet Exemple', // Remplace par les champs de ton modèle Objet
        ]);

        // Insérer une annonce en utilisant l'ID de l'objet
        Annonce::create([
            'date_publication' => Carbon::now(),
            'date_debut' => Carbon::now()->addDay(),
            'date_fin' => Carbon::now()->addMonth(),
            'statut' => 'active',
            'premium' => false,
            'adresse' => '123 Rue Exemple',
            'objet_id' => $objet->id,  // Référence à l'objet inséré
            'proprietaire_id' => 1,    // Assure-toi que l'utilisateur avec id = 1 existe
        ]);
    }
}