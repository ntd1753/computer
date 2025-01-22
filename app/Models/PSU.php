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

}
