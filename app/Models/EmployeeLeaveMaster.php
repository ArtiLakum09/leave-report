<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeLeaveMaster extends Model
{
    use HasFactory;

    protected $table = 'employee_leave_master';

    protected $fillable = [
        'leavetype',
        'employeecode',
        'fromdate',
        'todate',
        'numberofDays',
        'comment',
    ];

    public function leaveType()
    {
        return $this->belongsTo(LeaveMaster::class, 'leavetype');
    }
}
