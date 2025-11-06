<?php

namespace Database\Seeders;

use App\Models\Buildings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buildings::insert([
            [
                'name' => 'Education Building',
                'icon' => 'fa-solid fa-building-columns',
                'description' => 'Main academic building used for classroom lectures, faculty offices, and academic support services.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sports Academy Building',
                'icon' => 'fa-solid fa-dumbbell',
                'description' => 'Facility dedicated for athletic training, indoor sports activities, and physical education programs.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dormitel Building',
                'icon' => 'fa-solid fa-bed',
                'description' => 'Residential building that houses students and staff, providing shared rooms and common living areas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'AGETAC Buildings',
                'icon' => 'fa-solid fa-tools',
                'description' => 'Administrative and technical support building used for equipment storage, logistics, and maintenance operations.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
