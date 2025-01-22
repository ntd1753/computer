<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    use HasFactory;
    protected $table = 'fans';
    protected $fillable = [
        'type',
        'CPU_socket',
        'height',
        'fan_size',
        'led_type'
    ];
}
