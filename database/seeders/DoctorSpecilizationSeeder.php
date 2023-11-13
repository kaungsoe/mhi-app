<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSpecilizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctor_specialization')->insert([
            [
                'doctor_id' => '1',
                'specialization_id' => '8'
            ],
            [
                'doctor_id' => '2',
                'specialization_id' => '11'
            ],
            [
                'doctor_id' => '3',
                'specialization_id' => '9'
            ],
        ]);
    }
}
