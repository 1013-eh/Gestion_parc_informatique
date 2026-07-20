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
        Marque::create(['nom_marque' => 'ACER', 'id_sous_famille' => 1]);

        Marque::create(['nom_marque' => 'Lenovo', 'id_sous_famille' => 2]);
        Marque::create(['nom_marque' => 'ACER', 'id_sous_famille' => 2]);

        Marque::create(['nom_marque' => 'HP', 'id_sous_famille' => 3]);

        Marque::create(['nom_marque' => 'Brother', 'id_sous_famille' => 4]);

        Marque::create(['nom_marque' => 'Epson', 'id_sous_famille' => 5]);

        Marque::create(['nom_marque' => 'OLIVETTI', 'id_sous_famille' => 6]);

        Marque::create(['nom_marque' => 'Triumph Adler', 'id_sous_famille' => 7]);

        Marque::create(['nom_marque' => 'Brother', 'id_sous_famille' => 8]);

        Marque::create(['nom_marque' => 'Samsung', 'id_sous_famille' => 9]);

        Marque::create(['nom_marque' => 'HP', 'id_sous_famille' => 10]);

        Marque::create(['nom_marque' => 'ZEBRA', 'id_sous_famille' => 11]);

        Marque::create(['nom_marque' => 'APC', 'id_sous_famille' => 12]);

        Marque::create(['nom_marque' => 'Synology', 'id_sous_famille' => 13]);

        Marque::create(['nom_marque' => 'Dell PowerEdge', 'id_sous_famille' => 14]);

        Marque::create(['nom_marque' => 'Cisco', 'id_sous_famille' => 15]);

        Marque::create(['nom_marque' => 'AND', 'id_sous_famille' => 16]);

        Marque::create(['nom_marque' => 'Machine BiLL Counter', 'id_sous_famille' => 17]);

        Marque::create(['nom_marque' => 'Nagler', 'id_sous_famille' => 18]);

        Marque::create(['nom_marque' => 'Packaging System', 'id_sous_famille' => 19]);

        Marque::create(['nom_marque' => 'pitney Bowes', 'id_sous_famille' => 20]);

        Marque::create(['nom_marque' => 'Neopost', 'id_sous_famille' => 21]);

        Marque::create(['nom_marque' => 'FORTINET', 'id_sous_famille' => 22]);

        Marque::create(['nom_marque' => 'CISCO 800', 'id_sous_famille' => 23]);

        Marque::create(['nom_marque' => 'ARUBA', 'id_sous_famille' => 24]);

        Marque::create(['nom_marque' => 'DATALOGIC', 'id_sous_famille' => 25]);

        Marque::create(['nom_marque' => 'AUCUNE', 'id_sous_famille' => 26]);

        Marque::create(['nom_marque' => 'SHARP', 'id_sous_famille' => 27]);

        Marque::create(['nom_marque' => 'MDTCSM18-2', 'id_sous_famille' => 18]);
    }
}
