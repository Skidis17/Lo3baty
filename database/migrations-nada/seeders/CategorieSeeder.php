<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        // Insertion en masse de catégories
        Categorie::insert([
            ['nom' => 'Jouet Bébé'],
            ['nom' => 'Puzzle'],
            ['nom' => 'Lego'],
            ['nom' => 'Jeu de société'],
            ['nom' => 'Véhicules'],
            ['nom' => 'Jeux éducatifs'],
            ['nom' => 'Poupées'],
            ['nom' => 'Voitures télécommandées'],
            ['nom' => 'Jeux de construction'],
            ['nom' => 'Drones'],
            ['nom' => 'Instruments de musique pour enfants'],
            ['nom' => 'Articles de sport pour enfants']
        ]);
    }
}
