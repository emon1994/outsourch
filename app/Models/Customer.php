<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'country',
        'fb_id_link',
        'dob',
        'address',
        'dress_size',
        'shoe_size',
        'discount',
        'status',
        'review',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
