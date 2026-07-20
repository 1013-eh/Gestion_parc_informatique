<?php

namespace Database\Seeders;

use App\Models\Centre;
use Illuminate\Database\Seeder;

class CentreSeeder extends Seeder
{
    public function run(): void
    {
        Centre::create([
            'code_bureau' => 67600,
            'nom_centre' => 'MARRAKECH CTD',
            'id_region' => 1,
            'matricule' => 1,
            'adresse_ip' => '172.27.17',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'ADMIN',
        ]);

        Centre::create([
            'code_bureau' => 73900,
            'nom_centre' => 'MARRAKECH CM',
            'id_region' => 1,
            'matricule' => '111115',
            'adresse_ip' => '172.27.18',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'PAR_CENTRE',
        ]);

        Centre::create([
            'code_bureau' => 96300,
            'nom_centre' => 'SAFI CD',
            'id_region' => 1,
            'matricule' => '111119',
            'adresse_ip' => '172.27.19',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'PAR_CENTRE',
        ]);

        Centre::create([
            'code_bureau' => 96403,
            'nom_centre' => 'MARRAKECH SYBA CD',
            'id_region' => 1,
            'matricule' => '111117',
            'adresse_ip' => '172.27.20',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'PAR_CENTRE',
        ]);

        Centre::create([
            'code_bureau' => 96506,
            'nom_centre' => 'BENGUERIR CLD',
            'id_region' => 1,
            'matricule' => '111112',
            'adresse_ip' => '172.27.21',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'PAR_CENTRE',
        ]);

        Centre::create([
            'code_bureau' => 96507,
            'nom_centre' => 'ESSAOUIRA CCC',
            'id_region' => 1,
            'matricule' => '111114',
            'adresse_ip' => '172.27.22',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'PAR_CENTRE',
        ]);

        Centre::create([
            'code_bureau' => 96517,
            'nom_centre' => 'YOUSSOUFIA CLD',
            'id_region' => 1,
            'matricule' => '111122',
            'adresse_ip' => '172.27.23',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'PAR_CENTRE',
        ]);

        Centre::create([
            'code_bureau' => 96518,
            'nom_centre' => 'TINEGHIR CLD',
            'id_region' => 1,
            'matricule' => '111121',
            'adresse_ip' => '172.27.24',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'PAR_CENTRE',
        ]);

        Centre::create([
            'code_bureau' => 96519,
            'nom_centre' => 'EL KELAA DES SRAGHNA CCC',
            'id_region' => 1,
            'matricule' => '111113',
            'adresse_ip' => '172.27.25',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'PAR_CENTRE',
        ]);

        Centre::create([
            'code_bureau' => 96603,
            'nom_centre' => 'SAFI CM',
            'id_region' => 1,
            'matricule' => '111120',
            'adresse_ip' => '172.27.26',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'PAR_CENTRE',
        ]);

        Centre::create([
            'code_bureau' => 96614,
            'nom_centre' => 'AGENCE AM MARRAKECH GUELIZ',
            'id_region' => 1,
            'matricule' => '111111',
            'adresse_ip' => '172.27.27',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'PAR_CENTRE',
        ]);

        Centre::create([
            'code_bureau' => 97105,
            'nom_centre' => 'OUARZAZATE CCC',
            'id_region' => 1,
            'matricule' => '111118',
            'adresse_ip' => '172.27.28',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'PAR_CENTRE',
        ]);
    }
}
