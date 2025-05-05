<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UtilisateurSeeder extends Seeder
{
    public function run(): void
    {
        Utilisateur::insert([
            [
                'nom' => 'Mohamed',
                'prenom' => 'Partenaire',
                'surnom' => 'MedBensPartner1',

                'email' => 'partner@example.com',
                'mot_de_passe' => Hash::make('password'),
                'role' => 'partenaire',
                'image_profil' => null,
                'cin_recto' => null,
                'cin_verso' => null,
            ],
            [
                'nom' => 'Omar',
                'prenom' => 'Client',
                'surnom' => 'OmarBensClient1',

                'email' => 'client@example.com',
                'mot_de_passe' => Hash::make('password'),
                'role' => 'client',
                'image_profil' => null,
                'cin_recto' => null,
                'cin_verso' => null,
            ],
        ]);
    }
}