<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'nom' => 'Admin',
            'prenom' => 'System',
            'email' => 'admin@example.com',
            'mot_pass' => Hash::make('password123')
        ]);
    }
}