<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackTypesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('feedback_types')->insert([
            [
                'type' => 'General'
            ],
            [
                'type' => 'Booking'
            ],
            [
                'type' => 'Service'
            ],
        ]);
    }
}
