<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmergencyHotline;

class EmergencyHotlineSeeder extends Seeder
{
    public function run(): void
    {
        $hotlines = [
            // Province of Laguna
            ['location' => 'Province of Laguna', 'number' => '911', 'label' => 'National Emergency'],
            ['location' => 'Province of Laguna', 'number' => '143', 'label' => 'Philippine Red Cross'],
            ['location' => 'Province of Laguna', 'number' => '117', 'label' => 'Philippine National Police'],
            ['location' => 'Province of Laguna', 'number' => '572-4672', 'label' => 'PDRRMO Laguna'],
            ['location' => 'Province of Laguna', 'number' => '501-2826', 'label' => 'Serbisyong Tama Action Center'],
            ['location' => 'Province of Laguna', 'number' => '0921-907-8886', 'label' => 'Emergency Response Team'],
            ['location' => 'Province of Laguna', 'number' => '545-9211', 'label' => 'Laguna Command Center'],

            // Calamba City
            ['location' => 'Calamba City', 'number' => '(049) 545 4119', 'label' => 'Rescue LDRRMD'],
            ['location' => 'Calamba City', 'number' => '(049) 545 1695', 'label' => 'Bureau of Fire Protection'],
            ['location' => 'Calamba City', 'number' => '545 6789', 'label' => 'Public Order and Safety Office'],
        ];

        foreach ($hotlines as $hotline) {
            EmergencyHotline::create($hotline);
        }
    }
}
