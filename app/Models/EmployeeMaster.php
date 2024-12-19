<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeMaster extends Model
{
    use HasFactory;
    protected $table = 'employee_master';

    protected $fillable = [
        'employee_name',
        'employee_code',
        'username',
        'email',
        'phone',
        'password',
        'address',
        'country',
        'state',
        'city',
        'zip',
    ];
}
