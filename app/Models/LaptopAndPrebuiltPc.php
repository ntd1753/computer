<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaptopAndPrebuiltPc extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'product_type',
        'screen_size',
        'cpu',
        'ram',
        'ram_memory',
        'battery_life',
        'vga',
        'mainboard',
        'power_supply',
        'cpu_fan',
        'hdd_size',
        'ssd_size',
    ];
    const TYPE_LAPTOP = 'LAPTOP';
    const TYPE_PC = 'PC';
    public static $listType = [
        self::TYPE_LAPTOP,
        self::TYPE_PC,
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function scopeId($query, $filter){
        return !empty($filter) ? $query->where('id', $filter) : $query;
    }
    public function scopeProductId($query, $filter){
        return !empty($filter) ? $query->where('product_id', $filter) : $query;
    }
    public function scopeProductType($query, $filter){
        return !empty($filter) ? $query->where('product_type', $filter) : $query;
    }


}
