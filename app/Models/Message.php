<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'client_id', 'master_id', 'user_type'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    // Универсальный метод для получения отправителя
    public function sender()
    {
        return $this->user_type === 'client'
            ? $this->belongsTo(Client::class, 'client_id')
            : $this->belongsTo(Master::class, 'master_id');
    }
}
