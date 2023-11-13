<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contact_types')->insert([
            [ 
                'type' => '0',
            ],
            [ 
                'type' => '1',
            ],
            [ 
                'type' => '2',
            ],
        ]);
    }
}
