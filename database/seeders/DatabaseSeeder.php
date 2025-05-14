<?php

namespace Database\Seeders;

use App\Models\User; // Corrige l'espace de noms pour User
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crée un utilisateur test
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Appelle le seeder des annonces
        $this->call([
            AnnonceSeeder::class,
        ]);
    }
}