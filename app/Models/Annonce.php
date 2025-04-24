<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $table='annonce';
    protected $fillable = [
        'date_debut',
        'date_fin',
        'statut',
        'premium',
        'adresse',
        'objet_id',
        'proprietaire_id'
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
    
}
