<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // for generating current date and time

class AnnonceSeeder extends Seeder
{
    public function run()
    {
        // Seed multiple rows in the 'annonce' table
        DB::table('annonce')->insert([
            [
                'date_publication' => Carbon::now(),
                'date_debut' => Carbon::now()->addDays(1), // Example: start date
                'date_fin' => Carbon::now()->addDays(7), // Example: end date
                'statut' => 'disponible', // Status
                'premium' => true, // Premium or not
                'adresse' => '1234 Rue de Paris, Paris, France', // Example address
                'objet_id' => 1, // You should replace with actual valid `objet_id`
                'proprietaire_id' => 1, // You should replace with actual valid `proprietaire_id`
            ],
            [
                'date_publication' => Carbon::now(),
                'date_debut' => Carbon::now()->addDays(2),
                'date_fin' => Carbon::now()->addDays(10),
                'statut' => 'indisponible',
                'premium' => false,
                'adresse' => '5678 Rue de Lyon, Lyon, France',
                'objet_id' => 2,
                'proprietaire_id' => 2,
            ],
            // Add more rows here...
        ]);
    }
}
