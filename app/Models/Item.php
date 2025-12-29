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

    public const TYPE = [
        1 => '日用品',
        2 => '文房具',
        3 => '家電',
        4 => '食品',
        5 => '飲料',
        6 => '家具',
        7 => 'その他',
    ];

    public const STORAGE = [
        1  => 'A-1',
        2  => 'A-2',
        3  => 'A-3',
        4  => 'A-4',
        5  => 'B-1',
        6  => 'B-2',
        7  => 'B-3',
        8  => 'B-4',
        9  => 'C-1',
        10 => 'C-2',
        11 => 'C-3',
        12 => 'C-4',
    ];

    public function getTypeLabelAttribute(): string
    {
        return self::TYPE[$this->type] ?? '不明';
    }

    /** 保管場所ラベル */
    public function getStorageLabelAttribute(): string
    {
        return self::STORAGE[$this->storage] ?? '不明';
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
