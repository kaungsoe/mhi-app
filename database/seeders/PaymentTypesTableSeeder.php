<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('payment_types')->insert([
            [
                'name' => 'Cash',
                'description' => 'Use cash payment for now. Other payments are coming soon'

            ],
        ]);
    }
}
