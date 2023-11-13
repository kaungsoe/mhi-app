<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            [ 
                'contact_type_id' => '0',
                'value' => 'mhi@hospital.com'
            ],
            [ 
                'contact_type_id' => '1',
                'value' => '09421074733'
            ],
            [ 
                'contact_type_id' => '2',
                'value' => 'https://www.mhi.com'
            ],
        ]);
    }
}