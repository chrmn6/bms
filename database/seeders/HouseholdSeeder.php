<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Household;

class HouseholdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $householdNumbers = [
            'Blk 1, Lot 1-A',
            'Blk 1, Lot 1-B',
            'Blk 1, Lot 1-C',
            'Blk 2, Lot 1-A',
            'Blk 2, Lot 1-B',
            'Blk 2, Lot 1-C',
            'Blk 3, Lot 1-A',
            'Blk 3, Lot 1-B',
            'Blk 3, Lot 1-C',
            'Blk 4, Lot 1-A',
            'Blk 4, Lot 1-B',
            'Blk 4, Lot 1-C',
            'Blk 5, Lot 1-A',
            'Blk 5, Lot 1-B',
            'Blk 5, Lot 1-C'
        ];

        foreach ($householdNumbers as $number) {
            Household::create([
                'household_number' => $number,
            ]);
        }
    }
}
