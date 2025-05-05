<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'ville',
        'prix_journalier',
        'etat',
        'categorie_id',
        'proprietaire_id'
    ];

    protected $casts = [
        'date_ajout' => 'datetime',
        'etat' => 'string'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function proprietaire()
    {
        return $this->belongsTo(Utilisateur::class, 'proprietaire_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }
}

