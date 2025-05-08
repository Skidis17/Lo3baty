<?php

namespace Database\Seeders;

use App\Models\Annonce;
use Illuminate\Database\Seeder;

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
                'statut' => 'active',
                'adresse' => 'Rue des Jouets, Tétouan',
            ],
            [
                'objet_id' => 2,
                'proprietaire_id' => 1,
                'prix_journalier' => 30.00,
                'date_publication' => now(),
                'date_debut' => now(),
                'date_fin' => now()->addMonths(3),
                'statut' => 'active',
                'adresse' => 'Rue des Jouets, Tétouan',
            ],
            [
                'objet_id' => 3,
                'proprietaire_id' => 1,
                'prix_journalier' => 60.00,
                'date_publication' => now(),
                'date_debut' => now(),
                'date_fin' => now()->addMonths(3),
                'statut' => 'active',
                'adresse' => 'Rue des Jouets, Fes',
            ],
        ]);
    }
}
