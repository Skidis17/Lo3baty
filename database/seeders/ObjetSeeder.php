<?php

namespace Database\Seeders;

use App\Models\Objet;
use Illuminate\Database\Seeder;

class ObjetSeeder extends Seeder
{
    public function run(): void
    {
        Objet::insert([
            [
                'nom' => 'Vélo enfant',
                'description' => 'Vélo de 6 à 10 ans, bon état.',
                'ville' => 'Tétouan',
                'etat' => 'bon_etat',
                'categorie_id' => 5, 
                'proprietaire_id' => 1, 
            ],
            [
                'nom' => 'Poupée en peluche',
                'description' => 'Poupée en peluche neuve.',
                'ville' => 'Tanger',
                'etat' => 'neuf',
                'categorie_id' => 2, 
                'proprietaire_id' => 1, 
            ],
            [
                'nom' => 'Lego 1000 pièces',
                'description' => 'Jeu de construction Lego de 1000 pièces, en très bon état.',
                'ville' => 'Chefchaouen',
                'etat' => 'bon_etat',
                'categorie_id' => 3, 
                'proprietaire_id' => 1, 
            ],
            [
                'nom' => 'Voiture télécommandée',
                'description' => 'Voiture télécommandée, utilisée mais fonctionnelle.',
                'ville' => 'Marrakech',
                'etat' => 'usage',
                'categorie_id' => 4, 
                'proprietaire_id' => 1, 
            ],
            [
                'nom' => 'Jeu de société Monopoly',
                'description' => 'Jeu de société Monopoly complet.',
                'ville' => 'Rabat',
                'etat' => 'bon_etat',
                'categorie_id' => 5, 
                'proprietaire_id' => 1,
            ],
        ]);
    }
}
