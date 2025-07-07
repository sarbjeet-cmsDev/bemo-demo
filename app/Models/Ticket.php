<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasUuids, HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'subject',
        'body',
        'category',
        'note',
        'status',
        'confidence',
        'explanation',
    ];

    protected $casts = [
        'subject' => 'string',
        'body' => 'string',
        'status' => 'string',
        'note' => 'string',
        'category' => 'string',
        'confidence' => 'float',
        'explanation' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
