<?php

namespace Database\Seeders;

use App\Models\Quarter;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // auto generate data in role table
        Role::create([
            'id' => 3,
            'role_name' => 'Student',
        ]);
        Role::create([
            'id' => 2,
            'role_name' => 'Admin',
        ]);
        Role::create([
            'id' => 1,
            'role_name' => 'Super Admin',
        ]);

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
