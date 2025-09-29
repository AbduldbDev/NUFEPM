<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExtinguisherLocations;

class ExtinguisherLocationsSeeder extends Seeder
{
    public function run(): void
    {
        $buildings = [
            'Education Building' => [
                'Lower Ground Floor',
                'Ground Floor',
                'Second Floor',
                'Third Floor',
                'Fourth Floor',
                'Fifth Floor',
            ],
            'Sports Academy Building' => [
                'Lower Ground Floor',
                'Ground Floor',
                'Second Floor',
                'Third Floor',
                'Upper Second Floor',
                'Upper Third Floor',
            ],
            'Dormitel Building' => [
                'Ground Floor',
                'Second Floor',
                'Third Floor',
                'Fourth Floor',
                'Fifth Floor',
            ],
            'AGETAC Building' => [
                'Lower Ground Floor',
                'Ground Floor',
                'Second Floor',
            ],
        ];


        foreach ($buildings as $building => $floors) {
            foreach ($floors as $floor) {
                for ($i = 1; $i <= 3; $i++) {
                    $roomNumber = rand(100, 999);

                    for ($spot = 1; $spot <= 2; $spot++) {
                        ExtinguisherLocations::create([
                            'created_by' => 1,
                            'building'   => $building,
                            'floor'      => $floor,
                            'room'       => 'Room ' . $roomNumber,
                            'spot'       => 'Spot ' . $spot,
                        ]);
                    }
                }
            }
        }
    }
}
