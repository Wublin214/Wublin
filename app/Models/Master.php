<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Master extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'gender',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function messages()
    {
        return $this->hasMany(Message::class, 'master_id');
    }

}
