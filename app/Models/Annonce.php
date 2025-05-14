<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_publication',
        'date_debut',
        'date_fin',
        'statut',
        'prix_journalier',
        'premium',
        'premium_periode',
        'premium_start_date',
        'adresse',
        'objet_id',
        'partenaire_id'
    ];

    protected $casts = [
        'date_publication' => 'date',
        'date_debut' => 'date',
        'date_fin' => 'date',
        'premium' => 'boolean',
        'premium_start_date' => 'datetime'
    ];

    public function objet()
    {
        return $this->belongsTo(Objet::class)->withDefault([
            'ville' => 'Ville inconnue',
            'prix_journalier' => 0
        ]);
    }

    public function partenaire()
    {
        return $this->belongsTo(Utilisateur::class, 'partenaire_id')->withDefault([
            'nom' => 'Anonyme',
            'prenom' => ''
        ]);
    }

    // Alias pour la relation (si vous voulez utiliser "proprietaire" au lieu de "partenaire")
    public function proprietaire()
    {
        return $this->partenaire();
    }
}