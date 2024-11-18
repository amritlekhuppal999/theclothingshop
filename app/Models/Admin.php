<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';


    /**
     * The attributes that are mass assignable.
     * columns that will receive user inputs, to protect them from sql injection
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'password',
        
        'admin_type',
        'admin_level',
        'status',
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
}
