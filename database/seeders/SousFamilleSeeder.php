<?php

namespace Database\Seeders;

use App\Models\SousFamille;
use Illuminate\Database\Seeder;

class SousFamilleSeeder extends Seeder
{
    public function run(): void
    {
        SousFamille::create(['nom_sous_famille' => 'PC Fixe', 'id_famille' => 1]);
        SousFamille::create(['nom_sous_famille' => 'PC Portable', 'id_famille' => 1]);

        SousFamille::create(['nom_sous_famille' => 'Laser', 'id_famille' => 2]);
        SousFamille::create(['nom_sous_famille' => 'Jet d\'encre', 'id_famille' => 2]);

        SousFamille::create(['nom_sous_famille' => 'Onduleur', 'id_famille' => 3]);
        SousFamille::create(['nom_sous_famille' => 'NAS', 'id_famille' => 3]);

        SousFamille::create(['nom_sous_famille' => 'Serveur', 'id_famille' => 4]);
        SousFamille::create(['nom_sous_famille' => 'Switch', 'id_famille' => 4]);
    }
}
