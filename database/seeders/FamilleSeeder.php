<?php

namespace Database\Seeders;

use App\Models\Famille;
use Illuminate\Database\Seeder;

class FamilleSeeder extends Seeder
{
    public function run(): void
    {
        Famille::create(['nom_famille' => 'Poste de Travail']);
        Famille::create(['nom_famille' => 'Imprimante']);
        Famille::create(['nom_famille' => 'Sauvegarde']);
        Famille::create(['nom_famille' => 'Salle Serveur']);
    }
}
