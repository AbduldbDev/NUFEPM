<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InspectionGuideContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inspection_guide_content')->insert([
            [

                'title' => 'Verify Location',
                'content' => 'Check that the fire extinguisher is installed in its designated location and easily accessible.',
                'image_path' => '/Image/Guide/step1.jpg',
                'step_number' => 1,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'Ensure Accessibility',
                'content' => 'Confirm that the fire extinguisher is fully visible and not blocked by equipment, furniture, or other obstacles.',
                'image_path' => '/Image/Guide/step2.jpg',
                'step_number' => 2,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'Check Pressure Gauge',
                'content' => 'Ensure the pressure gauge or indicator needle is within the operable range, confirming the extinguisher is properly charged.',
                'image_path' => '/Image/Guide/step3.jpg',
                'step_number' => 3,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'Confirm Extinguisher Fullness',
                'content' => 'Check that the extinguisher feels full by weighing or gently lifting ("hefting") it to ensure it has not been discharged.',
                'image_path' => '/Image/Guide/step4.jpg',
                'step_number' => 4,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'Inspect Physical Condition',
                'content' => 'Examine the extinguisher\'s tires, wheels, carriage, hose, and nozzle (for wheeled units) to ensure all parts are in good working condition.',
                'image_path' => '/Image/Guide/step5.jpg',
                'step_number' => 5,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'Test Indicator Function',
                'content' => 'Verify that the push-to-test indicators on non-rechargeable models are functioning correctly to confirm readiness.',
                'image_path' => '/Image/Guide/step6.jpg',
                'step_number' => 6,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Verify Instructions Label',
                'content' => 'Ensure the operating instructions on the nameplate are clear, legible, and facing outward for easy visibility during emergencies.',
                'image_path' => '/Image/Guide/step7.jpg',
                'step_number' => 7,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'Check Safety Seals & Tamper Indicators',
                'content' => 'Verify that the safety seals and tamper indicators are not broken or missing.',
                'image_path' => '/Image/Guide/step8.jpg',
                'step_number' => 8,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'Check for Damage or Leaks',
                'content' => 'Examine the extinguisher for any visible dents, corrosion, leakage, or a clogged nozzle that could affect its performance.',
                'image_path' => '/Image/Guide/step9.jpg',
                'step_number' => 9,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'Agitate Extinguisher Powder',
                'content' => 'Invert and gently shake the extinguisher to loosen compacted powder at the bottom of the cylinder, ensuring proper discharge when needed.',
                'image_path' => '/Image/Guide/step10.jpg',
                'step_number' => 10,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'Update Inspection Record',
                'content' => 'Record the inspection date and the initials of the person who performed it on the extinguisher\'s inspection tag or log.',
                'image_path' => '/Image/Guide/step11.jpg',
                'step_number' => 11,

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
