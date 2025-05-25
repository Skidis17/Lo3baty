<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
   
    use HasFactory, Notifiable;
    protected $table = 'admin';

    protected $fillable = ['nom', 'prenom', 'email', 'password'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    //public function setMotPassAttribute($value)
    //{
    //    $this->attributes['password'] = Hash::make($value);
    //}
}