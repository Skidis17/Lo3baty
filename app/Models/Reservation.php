<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'client_id',
        'annonce_id',
        'date_debut',
        'date_fin',
        'statut'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date'
    ];

    public function client()
    {
        return $this->belongsTo(Utilisateur::class, 'client_id');
    }

    public function annonce()
    {
        return $this->belongsTo(Annonce::class , 'annonce_id');
    }

    public function getStatutCouleurAttribute()
    {
       return match(strtolower($this->statut)) {
    'confirmée' => 'bg-green-100 text-green-800',
    'en_attente' => 'bg-yellow-100 text-yellow-800',
    default => 'bg-red-100 text-red-800'
};

    }
}