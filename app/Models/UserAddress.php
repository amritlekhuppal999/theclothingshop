<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_address';

    
    protected $fillable = [
        'user_id',
        'name',
        'apartment_no',
        'building_no',
        'building_name',
        'city',
        'state',
        'pincode',
        'street_name',
        'full_address',
        'phone',
        'primary',
        'address_category',
        'address_type'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
