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
        'adresse',
        'objet_id',
        'proprietaire_id',
        'premium_periode',
        'premium_start_date',
    ];

    protected $casts = [
        'date_publication' => 'datetime',
        'statut' => 'string'
    ];

    // Relations
    public function objet()
    {
        return $this->belongsTo(Objet::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function proprietaire()
{
    return $this->belongsTo(Utilisateur::class, 'proprietaire_id');
}
}
