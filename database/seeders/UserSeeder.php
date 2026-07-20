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
            'email' => 'admin@parc.com',
            'email_perso' => 'admin.perso@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => 2,
            'nom' => 'Responsable',
            'prenom' => 'Centre',
            'email' => 'responsable@parc.com',
            'email_perso' => 'responsable.perso@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => 3,
            'nom' => 'Admin',
            'prenom' => 'Rabat',
            'email' => 'admin.rabat@parc.com',
            'email_perso' => 'admin.rabat.perso@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        // Real users from base CENTRES sheet
        User::create([
            'matricule' => '111111',
            'nom' => 'MOURAD',
            'prenom' => 'BOUJANI',
            'email' => 'boujani.mourad@parc.com',
            'email_perso' => 'boujani.mourad@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '111112',
            'nom' => 'HILLALI MY ISMAIL',
            'prenom' => 'EL',
            'email' => 'el.hillalimyismail@parc.com',
            'email_perso' => 'el.hillalimyismail@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '111113',
            'nom' => 'CHAFIQ',
            'prenom' => 'OULHAJ',
            'email' => 'oulhaj.chafiq@parc.com',
            'email_perso' => 'oulhaj.chafiq@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '111114',
            'nom' => 'ABDERRAHMANE',
            'prenom' => 'SAMOUD',
            'email' => 'samoud.abderrahmane@parc.com',
            'email_perso' => 'samoud.abderrahmane@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '111115',
            'nom' => 'HASSAN',
            'prenom' => 'ES-GHAYAR',
            'email' => 'es-ghayar.hassan@parc.com',
            'email_perso' => 'es-ghayar.hassan@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '111116',
            'nom' => 'FATTAH SAID',
            'prenom' => 'EL',
            'email' => 'el.fattahsaid@parc.com',
            'email_perso' => 'el.fattahsaid@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '111117',
            'nom' => 'ABDELLATIF',
            'prenom' => 'IMNY',
            'email' => 'imny.abdellatif@parc.com',
            'email_perso' => 'imny.abdellatif@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '111118',
            'nom' => 'MENDILI FOUAD',
            'prenom' => 'EL',
            'email' => 'el.mendilifouad@parc.com',
            'email_perso' => 'el.mendilifouad@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '111119',
            'nom' => 'ABDELJALIL',
            'prenom' => 'HAIF',
            'email' => 'haif.abdeljalil@parc.com',
            'email_perso' => 'haif.abdeljalil@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '111120',
            'nom' => 'KHALID',
            'prenom' => 'ZARRAB',
            'email' => 'zarrab.khalid@parc.com',
            'email_perso' => 'zarrab.khalid@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '111121',
            'nom' => 'MUSTAPHA',
            'prenom' => 'MOUKSID',
            'email' => 'mouksid.mustapha@parc.com',
            'email_perso' => 'mouksid.mustapha@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '111122',
            'nom' => 'ABDESSAMAD',
            'prenom' => 'RAFIK',
            'email' => 'rafik.abdessamad@parc.com',
            'email_perso' => 'rafik.abdessamad@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '222222',
            'nom' => 'SOUMIA',
            'prenom' => 'SANAA',
            'email' => 'sanaa.soumia@parc.com',
            'email_perso' => 'sanaa.soumia@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '222223',
            'nom' => 'SAID',
            'prenom' => 'BOUZDAD',
            'email' => 'bouzdad.said@parc.com',
            'email_perso' => 'bouzdad.said@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '222224',
            'nom' => 'BABA ABDELKARIM',
            'prenom' => 'AIT',
            'email' => 'ait.babaabdelkarim@parc.com',
            'email_perso' => 'ait.babaabdelkarim@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '222225',
            'nom' => 'KHOUY ALI',
            'prenom' => 'OULAD',
            'email' => 'oulad.khouyali@parc.com',
            'email_perso' => 'oulad.khouyali@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '222226',
            'nom' => 'AHMED',
            'prenom' => 'TARIK',
            'email' => 'tarik.ahmed@parc.com',
            'email_perso' => 'tarik.ahmed@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '222227',
            'nom' => 'SAID',
            'prenom' => 'DAKANI',
            'email' => 'dakani.said@parc.com',
            'email_perso' => 'dakani.said@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);

        User::create([
            'matricule' => '333333',
            'nom' => 'AZIZ',
            'prenom' => 'DAMOUR',
            'email' => 'damour.aziz@parc.com',
            'email_perso' => 'damour.aziz@parc.com',
            'password' => Hash::make('password'),
            'etat' => 'ACTIVE',
        ]);
    }
}
