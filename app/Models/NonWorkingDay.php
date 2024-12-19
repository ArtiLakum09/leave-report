<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NonWorkingDay extends Model
{
    use HasFactory;

    protected $table = 'non_working_days';

    protected $fillable = [
        'date',
    ];
}
