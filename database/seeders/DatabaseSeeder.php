<?php

namespace Database\Seeders;

use App\Models\Quarter;
use App\Models\Role;
use App\Models\SchoolPersonnel;
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

        $admin = User::factory()->create([
            'email' => 'admin@admin.com',
            'role_id' => 2,
        ]);
       
        $admin->schoolPersonnel()->create([
            'sp_firstname' => 'Christian Kyle',
            'sp_middlename' => '',
            'sp_lastname' => 'Autor',
            'sp_mobile_number' => '091585855694',
            'sp_address' => 'Buenavista',
            'sp_sex' => 'Male',
            'sp_birthdate' => '2003-03-14',
            'sp_age' => 21,
            'sp_religion' => 'Roman Catholic',
            'sp_civil_status' => 'Single',
        ]);

        $superadmin = User::factory()->create([
            'email' => 'super@admin.com',
            'role_id' => 1,
        ]);
        
        $superadmin->schoolPersonnel()->create([
            'sp_firstname' => 'Jee Ann',
            'sp_middlename' => 'Macaputol',
            'sp_lastname' => 'Guinsod',
            'sp_mobile_number' => '09278366066',
            'sp_address' => 'Sibagat',
            'sp_sex' => 'Female',
            'sp_birthdate' => '2003-02-11',
            'sp_age' => 21,
            'sp_religion' => 'Roman Catholic',
            'sp_civil_status' => 'Single',
        ]);
    }
}
