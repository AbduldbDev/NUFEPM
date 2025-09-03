<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmergencyPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            // Education_Building
            [
                'building' => 'Education_Building',
                'floor' => 'LOWER GROUND FLOOR',
                'pdf' => '/pdf/EDUC.pdf'
            ],
            [
                'building' => 'Education_Building',
                'floor' => 'GROUND FLOOR',
                'pdf' => '/pdf/EDUC.pdf'
            ],
            [
                'building' => 'Education_Building',
                'floor' => 'SECOND FLOOR',
                'pdf' => '/pdf/EDUC.pdf'
            ],
            [
                'building' => 'Education_Building',
                'floor' => 'THIRD FLOOR',
                'pdf' => '/pdf/EDUC.pdf'
            ],
            [
                'building' => 'Education_Building',
                'floor' => 'FOURTH FLOOR',
                'pdf' => '/pdf/EDUC.pdf'
            ],
            [
                'building' => 'Education_Building',
                'floor' => 'FIFTH FLOOR',
                'pdf' => '/pdf/EDUC.pdf'
            ],

            // Sports_AcademyBuilding
            [
                'building' => 'Sports_Academy_Building',
                'floor' => 'LOWER GROUND FLOOR',
                'pdf' => '/pdf/INSPIRE.pdf'
            ],
            [
                'building' => 'Sports_Academy_Building',
                'floor' => 'GROUND FLOOR',
                'pdf' => '/pdf/INSPIRE.pdf'
            ],
            [
                'building' => 'Sports_Academy_Building',
                'floor' => 'SECOND FLOOR',
                'pdf' => '/pdf/INSPIRE.pdf'
            ],
            [
                'building' => 'Sports_Academy_Building',
                'floor' => 'UPPER SECOND FLOOR',
                'pdf' => '/pdf/INSPIRE.pdf'
            ],
            [
                'building' => 'Sports_Academy_Building',
                'floor' => 'THIRD FLOOR',
                'pdf' => '/pdf/INSPIRE.pdf'
            ],
            [
                'building' => 'Sports_Academy_Building',
                'floor' => 'UPPER THIRD FLOOR',
                'pdf' => '/pdf/INSPIRE.pdf'
            ],

            // Dormitel_Building
            [
                'building' => 'Dormitel_Building',
                'floor' => 'GROUND FLOOR',
                'pdf' => '/pdf/DORMITEL.pdf'
            ],
            [
                'building' => 'Dormitel_Building',
                'floor' => 'SECOND FLOOR',
                'pdf' => '/pdf/DORMITEL.pdf'
            ],
            [
                'building' => 'Dormitel_Building',
                'floor' => 'THIRD FLOOR',
                'pdf' => '/pdf/DORMITEL.pdf'
            ],
            [
                'building' => 'Dormitel_Building',
                'floor' => 'FOURTH FLOOR',
                'pdf' => '/pdf/DORMITEL.pdf'
            ],
            [
                'building' => 'Dormitel_Building',
                'floor' => 'FIFTH FLOOR',
                'pdf' => '/pdf/DORMITEL.pdf'
            ],

            // AGETAC_Building
            [
                'building' => 'AGETAC_Building',
                'floor' => 'LOWER GROUND FLOOR',
                'pdf' => '/pdf/AGETAC.pdf'
            ],
            [
                'building' => 'AGETAC_Building',
                'floor' => 'GROUND FLOOR',
                'pdf' => '/pdf/AGETAC.pdf'
            ],
            [
                'building' => 'AGETAC_Building',
                'floor' => 'SECOND FLOOR',
                'pdf' => '/pdf/AGETAC.pdf'
            ],
        ];

        DB::table('emergency_plans')->insert($plans);
    }
}
