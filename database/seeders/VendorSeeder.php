<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['name' => 'SecureServe'],
            ['name' => 'USBProtector'],
            ['name' => 'FranceProtection'],
            ['name' => 'MyDatas'],
            ['name' => 'ServerStrike'],
        ];
        DB::table('vendors')->insert($values);
    }
}
