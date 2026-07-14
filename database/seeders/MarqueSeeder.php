<?php

namespace Database\Seeders;

use App\Models\Marque;
use Illuminate\Database\Seeder;

class MarqueSeeder extends Seeder
{
    public function run(): void
    {
        Marque::create(['nom_marque' => 'HP', 'id_sous_famille' => 1]);
        Marque::create(['nom_marque' => 'Dell', 'id_sous_famille' => 1]);
        Marque::create(['nom_marque' => 'Lenovo', 'id_sous_famille' => 2]);

        Marque::create(['nom_marque' => 'Brother', 'id_sous_famille' => 3]);
        Marque::create(['nom_marque' => 'Epson', 'id_sous_famille' => 4]);

        Marque::create(['nom_marque' => 'APC', 'id_sous_famille' => 5]);
        Marque::create(['nom_marque' => 'Synology', 'id_sous_famille' => 6]);

        Marque::create(['nom_marque' => 'Dell PowerEdge', 'id_sous_famille' => 7]);
        Marque::create(['nom_marque' => 'Cisco', 'id_sous_famille' => 8]);
    }
}
