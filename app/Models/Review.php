<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'rating',
        'review',
        'spare1',
        'spare2',
        'spare3',
        'spare4',
    ];
}
