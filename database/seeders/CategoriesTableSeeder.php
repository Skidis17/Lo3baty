<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            'Jouets éducatifs',
            'Jeux de société',
            'Poupées',
            'Voitures télécommandées',
            'Jeux de construction'
        ];
    
        foreach ($categories as $categorie) {
            \App\Models\Categorie::create(['nom' => $categorie]);
        }
    }
}
