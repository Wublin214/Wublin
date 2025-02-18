<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Master extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $guard = 'masters';

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

    // Добавьте метод для получения полного имени, если это необходимо
    public function getFullNameAttribute()
    {
        return "{$this->FirstName} {$this->LastName}";
    }
}
