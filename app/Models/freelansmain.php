<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class freelansmain extends Model
{
    use Notifiable, HasFactory;
    protected $guard = 'freelansmains';
    protected $fillable = [
        'ProjectTitle',
        'ProjectDescription',
        'TypeOfWebsite',
        'DesignPreferences',
        'FunctionalRequirements',
        'Timeline',
        'Budget',
        'Content',
        'SEOConsiderations',
        'ContactInformation',
        'status'=>'posted',
        'master_id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'ProjectTitle',
        'remember_token',
    ];
}
