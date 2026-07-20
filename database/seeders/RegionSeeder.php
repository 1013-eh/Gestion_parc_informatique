<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        Region::create(['libelle_region' => 'Marrakech', 'abreviation' => 'MRK']);
        Region::create(['libelle_region' => 'Agadir', 'abreviation' => 'AGR']);
    }
}
