<?php

namespace Database\Seeders;

use App\Models\Clearance;
use App\Models\SchoolPersonnel;
use App\Models\Student;
use App\Models\User;
use Database\Factories\UserFactory;
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

        $this->call([
            RoleSeeder::class,
            QuarterSeeder::class
        ]);

        SchoolPersonnel::factory(50)->create();

        Student::factory(100)
            ->has(Clearance::factory(5))
            ->create();

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
