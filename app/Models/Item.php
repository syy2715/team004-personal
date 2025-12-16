<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'name',
        'price',
        'type',
        'storage',
        'stock',
        'avg_rating',
        'description',
        'resolved',
        'spare1',
        'spare2',
        'spare3',
        'spare4',
    ];

        public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
