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
                'etat' => 'neuf',
                'categorie_id' => 3,
                'proprietaire_id' => 1,
            ],
            [
                'nom' => 'Voiture télécommandée',
                'description' => 'Voiture rapide et résistante.',
                'ville' => 'Tétouan',
                'etat' => 'bon_etat',
                'categorie_id' => 5,
                'proprietaire_id' => 1,
                
            ],
            [
                'nom' => 'Voiture rouge',
                'description' => 'Voiture rapide.',
                'ville' => 'Tétouan',
                'etat' => 'use',
                'categorie_id' => 3,
                'proprietaire_id' => 1,
            ],
        ]);
    }
}

