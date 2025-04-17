<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'gender',
        'text',
        'textEducation',
        'phone',
        'telegram',
        'vk',
        'imag',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];



}
