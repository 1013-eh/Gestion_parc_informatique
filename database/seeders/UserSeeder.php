<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'matricule' => 1,
            'nom' => 'Admin',
            'prenom' => 'System',
            'email_perso' => 'admin.perso@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '11111111',
            'nom' => 'MOURAD',
            'prenom' => 'BOUJANI',
            'email_perso' => 'boujani.mourad@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '11111112',
            'nom' => 'HILLALI MY ISMAIL',
            'prenom' => 'EL',
            'email_perso' => 'el.hillalimyismail@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '11111113',
            'nom' => 'CHAFIQ',
            'prenom' => 'OULHAJ',
            'email_perso' => 'oulhaj.chafiq@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '11111114',
            'nom' => 'ABDERRAHMANE',
            'prenom' => 'SAMOUD',
            'email_perso' => 'samoud.abderrahmane@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '11111115',
            'nom' => 'HASSAN',
            'prenom' => 'ES-GHAYAR',
            'email_perso' => 'es-ghayar.hassan@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '11111116',
            'nom' => 'FATTAH SAID',
            'prenom' => 'EL',
            'email_perso' => 'el.fattahsaid@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '11111117',
            'nom' => 'ABDELLATIF',
            'prenom' => 'IMNY',
            'email_perso' => 'imny.abdellatif@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '11111118',
            'nom' => 'MENDILI FOUAD',
            'prenom' => 'EL',
            'email_perso' => 'el.mendilifouad@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '11111119',
            'nom' => 'ABDELJALIL',
            'prenom' => 'HAIF',
            'email_perso' => 'haif.abdeljalil@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '11111120',
            'nom' => 'KHALID',
            'prenom' => 'ZARRAB',
            'email_perso' => 'zarrab.khalid@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '11111121',
            'nom' => 'MUSTAPHA',
            'prenom' => 'MOUKSID',
            'email_perso' => 'mouksid.mustapha@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '11111122',
            'nom' => 'ABDESSAMAD',
            'prenom' => 'RAFIK',
            'email_perso' => 'rafik.abdessamad@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '22222222',
            'nom' => 'SOUMIA',
            'prenom' => 'SANAA',
            'email_perso' => 'sanaa.soumia@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '22222223',
            'nom' => 'SAID',
            'prenom' => 'BOUZDAD',
            'email_perso' => 'bouzdad.said@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '22222224',
            'nom' => 'BABA ABDELKARIM',
            'prenom' => 'AIT',
            'email_perso' => 'ait.babaabdelkarim@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '22222225',
            'nom' => 'KHOUY ALI',
            'prenom' => 'OULAD',
            'email_perso' => 'oulad.khouyali@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '22222226',
            'nom' => 'AHMED',
            'prenom' => 'TARIK',
            'email_perso' => 'tarik.ahmed@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '22222227',
            'nom' => 'SAID',
            'prenom' => 'DAKANI',
            'email_perso' => 'dakani.said@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '33333333',
            'nom' => 'AZIZ',
            'prenom' => 'DAMOUR',
            'email_perso' => 'damour.aziz@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);
    }
}
