<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UtilisateursTableSeeder extends Seeder
{
    public function run()
    {
        // Création d'un admin
        Utilisateur::create([
            'nom' => 'EL MOURABET',
            'prenom' => 'NADA',
            'email' => 'nadan@gmail.com',
            'mot_de_passe' => Hash::make('nada123'),
            'role' => 'proprietaire'
        ]);
    
    }
}