<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{
    use HasFactory;
    // Tên bảng nếu không tuân theo quy tắc đặt tên của Laravel
    protected $table = 'rams';

    // Các cột có thể gán hàng loạt (mass assignable)
    protected $fillable = [
        'ram_type',
        'memory_type',
        'memory_size',
        'bus',
    ];
}
