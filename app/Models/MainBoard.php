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

    public function detail(){
        return $this->hasOne(Accessory::class);
    }
    public static function  fillDataMainBoard($input,$mainBoard): void{
        $mainBoard->socket = $input['socket'];
        $mainBoard->chipset = $input['chipset'];
        $mainBoard->ram_slot = $input['ram_slot'];
        $mainBoard->size = $input['size'];
        $mainBoard->save();
    }
}
