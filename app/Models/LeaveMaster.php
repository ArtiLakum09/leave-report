<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveMaster extends Model
{
    use HasFactory;

    protected $table = 'leave_master';

    protected $fillable = [
        'leaveType',
    ];
}
