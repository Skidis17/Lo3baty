<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Utilisateur extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'utilisateurs';
    protected $fillable = [
        'nom', 
        'prenom', 
        'surnom',
        'email', 
        'mot_de_passe', 
        'role', 
        'image_profil',
        'is_active',
        'cin_recto', 
        'cin_verso',
        'email_verified_at',
    ];

    protected $casts = [
        'date_inscription' => 'datetime',
        'role' => 'string'
    ];

    protected $dates = [
        'email_verified_at',
    ];

    // Définir l'accès à la date d'email vérifié
    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('d/m/Y') : null;
    }

    // Récupérer l'URL de l'image de profil, si elle existe
    public function getImageProfilAttribute($value)
    {
        return $value ? url('storage/' . $value) : url('storage/default-profile.jpg');
    }

    // Relations

    public function reclamations()
    {
        return $this->hasMany(Reclamation::class, 'client_id');
    }

    public function objets()
    {
        return $this->hasMany(Objet::class, 'proprietaire_id');
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'proprietaire_id');
    }
    public function paiements()
    {
        return $this->hasMany(PaiementClient::class, 'client_id');
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'client_id');
    }

    // Mutator pour le mot de passe
    public function setMotDePasseAttribute($value)
    {
        $this->attributes['mot_de_passe'] = Hash::make($value);
    }
}