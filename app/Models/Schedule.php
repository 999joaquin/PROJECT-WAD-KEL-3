<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hari',
        'doctor_id',
        'schedule_start',
        'schedule_end',
        'specialization'
    ];

}
