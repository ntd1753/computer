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

    public static function fillDataVGA($input,$vga){
        $vga->vga_series = $input['vga_series'];
        $vga->memory_type = $input['memory_type'];
        $vga->memory_size = $input['memory_size'];
        $vga->inteface = $input['inteface'];
        $vga->export_port = $input['export_port'];
        $vga->save();
    }
}
