<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Utilisateur extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom', 
        'prenom', 
        'email', 
        'mot_de_passe', 
        'role', 
        'image_profil', 
        'cin_recto', 
        'cin_verso'
    ];

    protected $casts = [
        'date_inscription' => 'datetime',
        'role' => 'string'
    ];

    protected $dates = ['date_inscription'];

    // Relations

    public function objets()
    {
        return $this->hasMany(Objet::class, 'proprietaire_id');
    }


    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'proprietaire_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'client_id');
    }

    public function partnerEvaluations()
    {
    return $this->hasMany(Evaluation_on_partners::class, 'partner_id');
    }

    public function clientEvaluations()
    {
    return $this->hasMany(Evaluation_on_partners::class, 'client_id');
    }
    
    // Mutator pour le mot de passe
    public function setMotDePasseAttribute($value)
    {
        $this->attributes['mot_de_passe'] = Hash::make($value);
    }
}

