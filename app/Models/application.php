<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class application extends Model
{
    use HasFactory;


    protected $fillable = [
        'client_id',
        'master_id',
        'order_id'
    ];

}
