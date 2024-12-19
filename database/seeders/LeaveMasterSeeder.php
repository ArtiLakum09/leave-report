<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeaveMaster;

class LeaveMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaveTypes = [
            'Sick Leave',
            'Casual Leave',
            'Earned Leave',
            'Maternity Leave',
            'Paternity Leave',
            'Unpaid Leave',
            'Public Holiday',
        ];
        foreach ($leaveTypes as $leaveType) {
            LeaveMaster::create([
                'leaveType' => $leaveType,
            ]);
        }

        // Optionally, you can print a success message
        $this->command->info('Leave Master table seeded successfully!');
    }
}
