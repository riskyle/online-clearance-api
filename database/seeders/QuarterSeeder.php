<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quarter;

class QuarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // auto generate data in quarter table
        Quarter::create([
            'id' => 1,
            'quarter_name' => "1st Quarter"
        ]);
        Quarter::create([
            'id' => 2,
            'quarter_name' => "2nd Quarter"
        ]);
        Quarter::create([
            'id' => 3,
            'quarter_name' => "3rd Quarter"
        ]);
        Quarter::create([
            'id' => 4,
            'quarter_name' => "4th Quarter"
        ]);
    }
}
