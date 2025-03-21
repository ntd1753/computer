<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PSU extends Model
{
    use HasFactory;
    protected $table ='psus';
    protected $fillable = [
        'power_output',
        'power_standard',
        'connector_type'
    ];

    public static function fillDataPSU($input,$psu):void{
        $psu->power_output = $input['power_output'];
        $psu->power_standard = $input['power_standard'];
        $psu->connector_type = $input['connector_type'];
        $psu->save();
    }
}
