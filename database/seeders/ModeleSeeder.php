<?php

namespace Database\Seeders;

use App\Models\Modele;
use Illuminate\Database\Seeder;

class ModeleSeeder extends Seeder
{
    public function run(): void
    {
        Modele::create(['nom_modele' => 'ProBook 450', 'id_marque' => 1]);
        Modele::create(['nom_modele' => 'EliteBook 840', 'id_marque' => 1]);
        Modele::create(['nom_modele' => 'Latitude 5420', 'id_marque' => 2]);
        Modele::create(['nom_modele' => 'ThinkPad X1', 'id_marque' => 3]);
        Modele::create(['nom_modele' => 'HL-L2370DN', 'id_marque' => 4]);
        Modele::create(['nom_modele' => 'L3250', 'id_marque' => 5]);
        Modele::create(['nom_modele' => 'Smart-UPS 1500', 'id_marque' => 6]);
        Modele::create(['nom_modele' => 'DS220+', 'id_marque' => 7]);
        Modele::create(['nom_modele' => 'R740', 'id_marque' => 8]);
        Modele::create(['nom_modele' => 'Catalyst 2960', 'id_marque' => 9]);
    }
}
