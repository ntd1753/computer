<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainBoard extends Model
{
    use HasFactory;
    protected $table = 'main_boards';
    protected $fillable = [
        'socket',
        'chipset',
        'ram_slot',
        'size'
    ];
}
