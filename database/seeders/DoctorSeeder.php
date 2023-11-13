<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctors')->insert([
            [ 
                'name' => 'Dr. Emily Rodriguez',
                'degree' => 'Doctor of Medicine (MD), Cardiology',
                'biography' => 'r. Emily Rodriguez is a renowned cardiologist with over 15 years of experience. She earned her MD from the prestigious Johns Hopkins School of Medicine. Dr. Rodriguez is passionate about preventive cardiology and has contributed to several research studies on heart health. Known for her compassionate approach, she strives to educate her patients about maintaining a heart-healthy lifestyle'
            ],
            [ 
                'name' => 'Dr. Marcus Turner',
                'degree' => 'Doctor of Osteopathic Medicine (DO), Orthopedics',
                'biography' => ' Dr. Marcus Turner is a board-certified orthopedic surgeon specializing in sports medicine. Holding a DO degree from the University of New England College of Osteopathic Medicine, he is committed to helping patients recover from musculoskeletal injuries. Dr. Turner has worked with professional athletes and is recognized for his expertise in arthroscopic surgeries and joint preservation techniques.'
            ],
            [ 
                'name' => 'Dr. Maya Patel',
                'degree' => 'Doctor of Medicine (MD), Neurology',
                'biography' => 'Dr. Maya Patel is a dedicated neurologist known for her expertise in treating complex neurological disorders. She earned her MD from Stanford University School of Medicine and completed her residency at the Mayo Clinic. Dr. Patel has a special interest in researching innovative therapies for neurodegenerative diseases. Her patient-centered approach and commitment to staying updated on the latest advancements make her a respected figure in the field.'
            ],
        ]);
    }
}
