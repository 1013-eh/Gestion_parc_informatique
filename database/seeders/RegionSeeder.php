<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        Region::create(['libelle_region' => 'Agadir', 'abreviation' => 'AGR']);
        Region::create(['libelle_region' => 'Casablanca', 'abreviation' => 'CAS']);
        Region::create(['libelle_region' => 'Rabat', 'abreviation' => 'RBT']);
        Region::create(['libelle_region' => 'Marrakech', 'abreviation' => 'MRK']);
        Region::create(['libelle_region' => 'Fès', 'abreviation' => 'FES']);
    }
}
