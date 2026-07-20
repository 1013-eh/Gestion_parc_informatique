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
        SousFamille::create(['nom_sous_famille' => 'Serveur', 'id_famille' => 1]);

        SousFamille::create(['nom_sous_famille' => 'Laser', 'id_famille' => 2]);
        SousFamille::create(['nom_sous_famille' => 'Jet d\'encre', 'id_famille' => 2]);
        SousFamille::create(['nom_sous_famille' => 'Imprimante Financiere', 'id_famille' => 2]);
        SousFamille::create(['nom_sous_famille' => 'Imprimante GR', 'id_famille' => 2]);
        SousFamille::create(['nom_sous_famille' => 'Imprimante Laser', 'id_famille' => 2]);
        SousFamille::create(['nom_sous_famille' => 'Imprimante MFC', 'id_famille' => 2]);
        SousFamille::create(['nom_sous_famille' => 'Imprimante MFP', 'id_famille' => 2]);
        SousFamille::create(['nom_sous_famille' => 'Imprimante Vignette', 'id_famille' => 2]);

        SousFamille::create(['nom_sous_famille' => 'Onduleur', 'id_famille' => 3]);
        SousFamille::create(['nom_sous_famille' => 'NAS', 'id_famille' => 3]);

        SousFamille::create(['nom_sous_famille' => 'Serveur', 'id_famille' => 4]);
        SousFamille::create(['nom_sous_famille' => 'Switch', 'id_famille' => 4]);

        SousFamille::create(['nom_sous_famille' => 'Balance Electronique', 'id_famille' => 5]);

        SousFamille::create(['nom_sous_famille' => 'Machine a Billet', 'id_famille' => 6]);
        SousFamille::create(['nom_sous_famille' => 'Machine a Obliterer', 'id_famille' => 6]);
        SousFamille::create(['nom_sous_famille' => 'Machine Enliasseuse', 'id_famille' => 6]);
        SousFamille::create(['nom_sous_famille' => 'Machine de Mise Sous Pli', 'id_famille' => 6]);
        SousFamille::create(['nom_sous_famille' => 'Machine a Affranchir', 'id_famille' => 6]);

        SousFamille::create(['nom_sous_famille' => 'Firewell', 'id_famille' => 7]);
        SousFamille::create(['nom_sous_famille' => 'Routeur', 'id_famille' => 7]);
        SousFamille::create(['nom_sous_famille' => 'Switch', 'id_famille' => 7]);

        SousFamille::create(['nom_sous_famille' => 'Lecteur Code a Barre AF', 'id_famille' => 9]);
        SousFamille::create(['nom_sous_famille' => 'Lecteur Code a Barre SF', 'id_famille' => 9]);

        SousFamille::create(['nom_sous_famille' => 'Copieur', 'id_famille' => 10]);
    }
}
