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

    public static function fillDataRam($input,$ram){
        $ram->ram_type = $input['ram_type'];
        $ram->memory_type = $input['memory_type'];
        $ram->memory_size = $input['memory_size'];
        $ram->bus = $input['bus'];
        $ram->save();
    }
}
