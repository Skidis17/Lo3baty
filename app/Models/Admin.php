<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    
    protected $fillable = [
        'nom', 
        'prenom', 
        'email', 
        'mot_pass'
    ];

    protected $hidden = [
        'mot_pass',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->mot_pass;
    }
}