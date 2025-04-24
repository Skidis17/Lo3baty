<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // for generating current date and time

class ObjetSeeder extends Seeder
{
    public function run()
    {
        DB::table('objet')->insert([
            [
                'nom' => 'Laptop',
                'description' => 'A high-performance laptop.',
                'ville' => 'Paris',
                'prix_journalier' => 30.00,
                'etat' => 'neuf',
                'categorie_id' => 1, // Example category ID
                'proprietaire_id' => 2, // Example proprietor ID
                'date_ajout' => Carbon::now(),
            ],
            [
                'nom' => 'Sofa',
                'description' => 'Comfortable leather sofa.',
                'ville' => 'Lyon',
                'prix_journalier' => 15.00,
                'etat' => 'bon etat',
                'categorie_id' => 2,
                'proprietaire_id' => 2,
                'date_ajout' => Carbon::now(),
            ]
        ]);
    }
}
