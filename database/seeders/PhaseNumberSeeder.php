<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Phase;

class PhaseNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phaseNumbers = [
            'Phase 1',
            'Phase 2',
            'Phase 3',
            'Phase 4',
            'Phase 5',
            'Phase 6',
            'Phase 7',
            'Phase 8',
            'Phase 9',
            'Phase 10'
        ];

        foreach ($phaseNumbers as $number) {
            Phase::create([
                'phase_number' => $number,
            ]);
        }
    }
}
