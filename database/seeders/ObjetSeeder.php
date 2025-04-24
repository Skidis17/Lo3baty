<?php

namespace Database\Seeders;

use App\Models\Objet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObjetSeeder extends Seeder
{
    public function run(): void
    {
        Objet::insert([
            [
                'nom' => 'Lego Star Wars',
                'description' => 'Un set complet de Lego Star Wars.',
                'ville' => 'Tétouan',
                'prix_journalier' => 25.00,
                'etat' => 'Neuf',
                'categorie_id' => 3,
                'proprietaire_id' => 1,
            ],
            [
                'nom' => 'Voiture télécommandée',
                'description' => 'Voiture rapide et résistante.',
                'ville' => 'Tétouan',
                'prix_journalier' => 15.00,
                'etat' => 'Bon état',
                'categorie_id' => 5,
                'proprietaire_id' => 1,
            ],
        ]);
    }
}

