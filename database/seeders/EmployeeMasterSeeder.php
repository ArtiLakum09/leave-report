<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmployeeMaster;
use Faker\Factory as Faker;

class EmployeeMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate a set number of fake employee records (e.g., 50)
        for ($i = 0; $i < 50; $i++) {
            EmployeeMaster::create([
                'employee_name' => $faker->name, // Random full name
                'employee_code' => strtoupper($faker->unique()->lexify('?????')), // Random 5-letter employee code
                'username' => $faker->unique()->userName, // Random username
                'email' => $faker->unique()->safeEmail, // Random email
                'phone' => $faker->phoneNumber, // Random phone number
                'password' => bcrypt('password'), // Default password, hashed
                'address' => $faker->address, // Random address
                'country' => $faker->country, // Random country
                'state' => $faker->state, // Random state
                'city' => $faker->city, // Random city
                'zip' => $faker->postcode, // Random postal code
            ]);
        }

        // Optionally, print a success message
        $this->command->info('Employee Master table seeded successfully!');
    }
}
