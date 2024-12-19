<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveBalance extends Model
{
    use HasFactory;

    protected $table = 'leave_balance';

    protected $fillable = [
        'leavetype',
        'employeecode',
        'leavebalance',
    ];

    public function leaveType()
    {
        return $this->belongsTo(LeaveMaster::class, 'leavetype');
    }
}
