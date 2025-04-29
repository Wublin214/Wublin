<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
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


    public function messages()
    {
        return $this->hasMany(Message::class, 'client_id');
    }
}
