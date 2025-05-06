<?php

namespace Database\Seeders;

use App\Models\Annonce;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AnnonceSeeder extends Seeder
{
    public function run(): void
    {
        Annonce::insert([
            [
                'objet_id' => 1,
                'proprietaire_id' => 1,
                'prix_journalier' => 50.00,
                'date_publication' => now(),
                'date_debut' => now(),
                'date_fin' => now()->addMonths(3),
                'statut' => 'disponible',
                'adresse' => 'Rue des Jouets, Tétouan',
                'premium' => false,
                'premium_periode' => null,
                'premium_start_date' => null,
            ],
            [
                'objet_id' => 2,
                'proprietaire_id' => 1,
                'prix_journalier' => 30.00,
                'date_publication' => now(),
                'date_debut' => now(),
                'date_fin' => now()->addMonths(3),
                'statut' => 'disponible',
                'adresse' => 'Rue des Jouets, Tétouan',
                'premium' => true,
                'premium_periode' => '15', 
                'premium_start_date' => now(),
            ],
        ]);
    }
}
