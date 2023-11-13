<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specializations')->insert([
            [
                'name' => 'Cardiology',
                "description" => 'Cardiologists specialize in the diagnosis and treatment of heart-related conditions and diseases. They may focus on areas such as heart failure, arrhythmias, and coronary artery disease.',
            ],
            [
                'name' => 'Neurology',
                "description" => 'Neurologists specialize in disorders of the nervous system, including the brain, spinal cord, and peripheral nerves. They diagnose and treat conditions like epilepsy, stroke, and neurodegenerative diseases.',
            ],
            [
                'name' => 'Gastroenterology',
                "description" => 'Gastroenterologists specialize in the digestive system, including the stomach, intestines, liver, and pancreas. They diagnose and treat conditions like inflammatory bowel disease, liver cirrhosis, and gastrointestinal cancers.',
            ],
            [ 
                'name' => 'Orthopedics',
                "description" => 'Orthopedic doctors specialize in the musculoskeletal system, dealing with conditions related to bones, joints, ligaments, tendons, and muscles. They may perform surgeries for joint replacements and fracture repairs.',

            ]
        ]);
    }
}
