<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VGA extends Model
{
    use HasFactory;
    protected $table = 'vgas';
    protected $fillable = [
        'vga_series',
        'memory_type',
        'memory_size',
        'inteface',
        'export_port'
    ];
}
