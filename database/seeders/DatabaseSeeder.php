<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RegionSeeder::class,
            UserSeeder::class,
            FamilleSeeder::class,
            SousFamilleSeeder::class,
            CentreSeeder::class,
            MarqueSeeder::class,
            ModeleSeeder::class,
            MaterielSeeder::class,
        ]);
    }
}
