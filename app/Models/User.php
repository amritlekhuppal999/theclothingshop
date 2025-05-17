<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     * columns that will receive user inputs, to protect them from sql injection
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'role',
        'name',
        'email',
        'phone_no',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization. 
     * These fields/column values will not be the part of the response array when requested.
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast. (Type Cast)
     * You sepcify those columns which you want in a specific data type.
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // protected static function boot(){
    //     parent::boot();

    //     static::creating(function ($model) {
    //         if (empty($model->user_id)) {
    //             $model->user_id = (string) Str::uuid();
    //         }
    //     });
    // }
}
