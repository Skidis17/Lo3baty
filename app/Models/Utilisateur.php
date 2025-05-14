<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
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
    'is_active',
    'image_profil',
    'cin_recto',
    'cin_verso'
  ];

  protected $hidden = [
    'mot_de_passe',
    'remember_token',
  ];

  protected $casts = [
    'is_active' => 'boolean',
    'email_verified_at' => 'datetime',
  ];

  public function getAuthPassword()
  {
    return $this->mot_de_passe;
  }

  public function annonces()
  {
    return $this->hasMany(Annonce::class, 'partenaire_id');
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
  public function getProfileImageAttribute()
{
    return $this->image_profil 
        ? asset('storage/' . $this->image_profil)
        : asset('images/default-profile.png');
}
}
