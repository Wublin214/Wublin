<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Client extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'FirstName',
        'LastName',
        'Email',
        'Password',
        'Gender',
    ];

    protected $hidden = [
        'Password',
        'remember_token',
    ];
}
