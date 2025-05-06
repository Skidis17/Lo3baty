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
        'is_active',
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

    public function evaluationsPartenaire()
    {
    return $this->hasMany(EvaluationOnPartner::class, 'partner_id');
    }

    public function evaluationsClient()
    {
    return $this->hasMany(EvaluationOnPartner::class, 'client_id');
    }

    public function getNoteMoyenneAttribute()
    {
        return $this->evaluationsPartenaire->avg('note') ?? 0;
    }
    
    public function isPartner()
    {
    return $this->role === 'partenaire';
    }
    
    public function getAuthPassword()
    {
      return $this->mot_de_passe;
    }
  
    
  // Méthodes pratiques
  public function activate()
  {
    $this->update(['is_active' => true]);
  }

  public function deactivate()
  {
    $this->update(['is_active' => false]);
  }

  public function isActive(): bool
  {
    return $this->is_active;
  }

    // Mutator pour le mot de passe
    public function setMotDePasseAttribute($value)
    {
        $this->attributes['mot_de_passe'] = Hash::make($value);
    }
}