<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'work_date',
        'clock_in',
        'clock_out',
        'break_in',
        'break_out',
    ];

    protected $casts = [
        'work_date' => 'date',
        'clock_in' => 'datetime:H:i:s',
        'clock_out' => 'datetime:H:i:s',
        'break_in' => 'datetime:H:i:s',
        'break_out' => 'datetime:H:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(Employee::class);
    }
}

