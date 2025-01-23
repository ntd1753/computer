<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CPU extends Model
{
    use HasFactory;
    protected $table ='cpus';
    protected $fillable = [
        'core_type',
        'core_series',
        'socket'
    ];
    public function detail(){
        return $this->hasOne(Accessory::class);
    }

    public static function fillDataCPU($input,$cpu):void{
        $cpu->core_type = $input['core_type'];
        $cpu->core_series = $input['core_series'];
        $cpu->socket = $input['socket'];
        $cpu->save();
    }
}
