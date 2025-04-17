<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioClients extends Model
{
    protected $fillable = [
        'id',
        'clients_id',
        'title',
        'description',
    ];
}
