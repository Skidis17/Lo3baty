<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Objet;
use App\Models\Utilisateur;

use Illuminate\Database\Seeder;



class ObjetsTableSeeder extends Seeder
{
    public function run()
    {
        $proprietaires = Utilisateur::where('role', 'proprietaire')->get();
        $categories = Categorie::all();

        foreach ($proprietaires as $proprietaire) {
            Objet::factory(rand(2, 5))->create([
                'proprietaire_id' => $proprietaire->id,
                'categorie_id' => $categories->random()->id
            ]);
        }
    }
}