<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
