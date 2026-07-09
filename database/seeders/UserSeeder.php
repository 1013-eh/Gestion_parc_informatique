<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'matricule' => 1,
            'nom' => 'Admin',
            'prenom' => 'System',
            'email' => 'admin@parc.com',
            'email_perso' => 'admin.perso@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => 2,
            'nom' => 'Responsable',
            'prenom' => 'Centre',
            'email' => 'responsable@parc.com',
            'email_perso' => 'responsable.perso@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);
    }
}
