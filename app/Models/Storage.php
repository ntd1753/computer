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
    const TYPE_SSD = 'SSD';
    const TYPE_HDD = 'HDD';
    public static $listType = [
        self::TYPE_SSD => 'SSD',
        self::TYPE_HDD => 'HDD'
    ];
    public static function fillDataStorage($input,$storage){
        $storage->storage_type = $input['storage_type'];
        $storage->size = $input['size'];
        $storage->SSD_type = $input['SSD_type'];
        $storage->HDD_SPEED = $input['HDD_SPEED'];
        $storage->HDD_CACHE = $input['HDD_CACHE'];
        $storage->save();
    }
    public static function getStorageType($type){
        return self::where('storage_type', $type)
            ->join('accessories', 'accessories.detail_id', '=', 'storages.id')
            ->where('accessories.type', Accessory::TYPE_STORAGE)
            ->join('products', 'products.detail_id', '=', 'accessories.id')
            ->select('products.id as product_id', 'products.name as product_name')
            ->get();
    }
}
