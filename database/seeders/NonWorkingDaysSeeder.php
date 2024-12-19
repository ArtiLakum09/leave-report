<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NonWorkingDaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nonWorkingDays = [
            ['date' => '2024-01-01'], // New Year's Day
            ['date' => '2024-01-26'], // Republic Day
            ['date' => '2024-08-15'], // Independence Day
            ['date' => '2024-10-02'], // Gandhi Jayanti
            ['date' => '2024-12-25'], // Christmas Day
        ];

        DB::table('non_working_days')->insert($nonWorkingDays);
    }
}
