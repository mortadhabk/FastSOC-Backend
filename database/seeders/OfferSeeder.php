<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['name' => 'FastSOC Servers', 'description' => 'Permet de protéger les serveurs quantiques de nos clients.'],
            ['name' => 'FastSOC USB', 'description' => 'Permet le contrôle des ports USB et des accès aux fichiers via USB.'],
            ['name' => 'FastSOC Data', 'description' => 'Permet de contrôler les données entrantes et sortantes de l’entreprise grâce à des modules innovateurs d’intelligence artificielle basés sur le protocole CarotteDeux.'],
        ];

        DB::table('offers')->insert($values);

    }
}
