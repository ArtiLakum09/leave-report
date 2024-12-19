<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeaveBalance;
use App\Models\LeaveMaster;
use App\Models\EmployeeMaster;


class LeaveBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Get all employees
         $employees = EmployeeMaster::all();

         // Get all leave types
         $leaveTypes = LeaveMaster::all();
 
         // Loop through each employee and leave type to assign a leave balance
         foreach ($employees as $employee) {
             foreach ($leaveTypes as $leaveType) {
                 // Random leave balance for each employee and leave type
                 LeaveBalance::create([
                     'leavetype' => $leaveType->id,
                     'employeecode' => $employee->employee_code,
                     'leavebalance' => rand(5, 5), // Assign a random balance between 5 and 20
                     'created_at' => now(),
                     'updated_at' => now(),
                 ]);
             }
         }
 
         // Optionally, print a success message
         $this->command->info('Leave Balance table seeded successfully!');
    }
}
