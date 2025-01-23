<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;
    protected $table = 'storages';
    protected $fillable = [
        'storage_type',
        'size',
        'SSD_type',
        'HDD_SPEED',
        'HDD_CACHE'
    ];

    public static function fillDataStorage($input,$storage){
        $storage->storage_type = $input['storage_type'];
        $storage->size = $input['size'];
        $storage->SSD_type = $input['SSD_type'];
        $storage->HDD_SPEED = $input['HDD_SPEED'];
        $storage->HDD_CACHE = $input['HDD_CACHE'];
        $storage->save();
    }
}
