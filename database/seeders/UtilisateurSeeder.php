<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // for generating current date and time


class UtilisateurSeeder extends Seeder
{
    public function run()
    {
        DB::table('utilisateur')->insert([
            [
                'nom' => 'John',
                'prenom' => 'Doe',
                'email' => 'john.doe@example.com',
                'mot_de_passe' => bcrypt('password'),
                'role' => 'client',
                'image_profil' => null,
                'cin_recto' => null,
                'cin_verso' => null,
                'date_inscription' => Carbon::now(),
            ],
            [
                'nom' => 'Jane',
                'prenom' => 'Smith',
                'email' => 'jane.smith@example.com',
                'mot_de_passe' => bcrypt('password'),
                'role' => 'proprietaire',
                'image_profil' => null,
                'cin_recto' => null,
                'cin_verso' => null,
                'date_inscription' => Carbon::now(),
            ]
        ]);
    }
}
