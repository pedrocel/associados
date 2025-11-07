<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebhookLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'event',
        'status',
        'payload',
        'error_message',
    ];

    /**
     * Os atributos que devem ser convertidos.
     */
    protected $casts = [
        'payload' => 'array', // Garante que o payload é armazenado e recuperado como array/json
    ];
}