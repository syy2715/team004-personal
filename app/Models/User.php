<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLES = [
    1 => '管理者',
    2 => '上長',
    3 => '一般社員',
];

public function getRoleNameAttribute()
{
    return self::ROLES[$this->role] ?? '未設定';
}

    /**
     * 所属課マスタ（ID → 表示名）
     */
    public const GROUPS = [
            1 => '営業課',
            2 => '人事課',
            3 => '開発課',
            4 => '経理課',
    ];

    // 営業所マスタを追加
    public const SALES_OFFICES = [
        1 => '東京営業所',
        2 => '大阪営業所',
        3 => '名古屋営業所',
        4 => '福岡営業所',
    ];
    
     /*
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'address',
        'phone',
        
        // 'group'ではなくこちらを使用
        'group_id',

        'role',
        'sales_office',
        'start_day',
        'spare1',
        'spare2',
        'spare3',
        'spare4',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /**
     * 所属課名を取得（group_id → 表示名）
     */
    public function getGroupNameAttribute()
    {
        return self::GROUPS[$this->group_id] ?? '未設定';
    }
}
