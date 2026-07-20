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

        Modele::create(['nom_modele' => 'VERITON X2632G', 'id_marque' => 3]);

        Modele::create(['nom_modele' => 'ThinkPad X1', 'id_marque' => 4]);

        Modele::create(['nom_modele' => 'TravelMate P259-G2-M', 'id_marque' => 5]);

        Modele::create(['nom_modele' => 'PRIMRY', 'id_marque' => 6]);

        Modele::create(['nom_modele' => 'HL-L2370DN', 'id_marque' => 7]);

        Modele::create(['nom_modele' => 'L3250', 'id_marque' => 8]);

        Modele::create(['nom_modele' => 'PR2 PLUS', 'id_marque' => 9]);

        Modele::create(['nom_modele' => 'P-5030DN', 'id_marque' => 10]);

        Modele::create(['nom_modele' => 'HL-6050', 'id_marque' => 11]);

        Modele::create(['nom_modele' => 'M2675F Xpress', 'id_marque' => 12]);

        Modele::create(['nom_modele' => 'HP E72535dn', 'id_marque' => 13]);

        Modele::create(['nom_modele' => 'ZD420', 'id_marque' => 14]);

        Modele::create(['nom_modele' => 'Smart-UPS 1500', 'id_marque' => 15]);

        Modele::create(['nom_modele' => 'DS220+', 'id_marque' => 16]);

        Modele::create(['nom_modele' => 'R740', 'id_marque' => 17]);

        Modele::create(['nom_modele' => 'Catalyst 2960', 'id_marque' => 18]);

        Modele::create(['nom_modele' => 'HT 3000 g', 'id_marque' => 19]);

        Modele::create(['nom_modele' => 'HL', 'id_marque' => 20]);

        Modele::create(['nom_modele' => 'SN 530', 'id_marque' => 21]);

        Modele::create(['nom_modele' => 'PW-0860A', 'id_marque' => 22]);

        Modele::create(['nom_modele' => 'MISE SOUS PLI DI380', 'id_marque' => 23]);

        Modele::create(['nom_modele' => 'IJ90  NP0067', 'id_marque' => 24]);

        Modele::create(['nom_modele' => 'FORTIGATE 40F', 'id_marque' => 25]);

        Modele::create(['nom_modele' => 'CISCO 881', 'id_marque' => 26]);

        Modele::create(['nom_modele' => 'INSTANT ON 1830', 'id_marque' => 27]);

        Modele::create(['nom_modele' => 'QW2120-BKK1S', 'id_marque' => 28]);

        Modele::create(['nom_modele' => 'Fournisseur TRAFFITEC', 'id_marque' => 29]);

        Modele::create(['nom_modele' => 'AR-5316E', 'id_marque' => 30]);

        Modele::create(['nom_modele' => 'MDTCSM18-2', 'id_marque' => 31]);
    }
}
