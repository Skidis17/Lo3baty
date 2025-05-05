<?php

namespace Database\Factories;

use App\Models\Objet;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObjetFactory extends Factory
{
    protected $model = Objet::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'ville' => $this->faker->city,
            'prix_journalier' => $this->faker->randomFloat(2, 5, 100),
            'etat' => $this->faker->randomElement(['neuf','bon etat','usage','a reparer']),
            'categorie_id' => \App\Models\Categorie::factory(),
            'proprietaire_id' => \App\Models\Utilisateur::factory()
        ];
    }
}