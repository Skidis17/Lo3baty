<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UtilisateurSeeder extends Seeder
{
    public function run()
    {
        // Création du 1 er utilisateur
        Utilisateur::create([
            'nom' => 'EL MOURABET',
            'prenom' => 'NADA',
            'surnom' => 'e_nada',
            'email' => 'nada.elmourabet@etu.uae.ac.ma',
            'mot_de_passe' => Hash::make('nada123'),
            'role' => 'client',
            'is_active' => true,
            'email_verified_at' => now(), 
        ]);

        // Création du 2 eme utilisateur
        Utilisateur::create([
            'nom' => 'Assiya',
            'prenom' => 'El ouazgani',
            'surnom' => 'assi_ya',
            'email' => 'assiya@gmail.com',
            'mot_de_passe' => Hash::make('assia123'),
            'role' => 'client', 
            'is_active' => true,
            'email_verified_at' => now(), 
        ]);
    }
}
