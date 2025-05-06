<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Création d'un administrateur
        Admin::create([
            'nom' => 'Chaymae',
            'prenom' => 'Houda',
            'email' => 'admin@lo3baty.com',
            'mot_pass' => 'admin123',
        ]);
    }
}
