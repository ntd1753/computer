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

    public function detail(){
        return $this->hasOne(Accessory::class);
    }
     public static function fillDataFan($input,$fan):void{
        $fan->type = $input['type'];
        $fan->CPU_socket = $input['CPU_socket'];
        $fan->height = $input['height'];
        $fan->fan_size = $input['fan_size'];
        $fan->led_type = $input['led_type'];
        $fan->save();
    }
}
