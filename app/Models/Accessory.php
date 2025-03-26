<?php

namespace App\Models;

use App\Traits\addAccessory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Accessory extends Model
{
    use HasFactory;
    protected $table = 'accessories';
    protected $with = ['product'];
    protected $fillable = [
        'brand_id',
        'type',
        'detail_id',
        'dataSheet',
    ];


    // Các giá trị có thể có của trường "type"
    const TYPE_CPU = 'CPU';
    const TYPE_RAM = 'RAM';
    const TYPE_STORAGE = 'STORAGE';
    const TYPE_PSU = 'PSU';
    const TYPE_CASE = 'CASE';
    const TYPE_MAINBOARD = 'MAINBOARD';
    const TYPE_FAN = 'FAN';
    const TYPE_VGA = 'VGA';

    // Danh sách các loại phụ kiện
    public static $listType = [
        self::TYPE_CPU => 'CPU',
        self::TYPE_RAM => 'RAM',
        self::TYPE_STORAGE => 'Storage',
        self::TYPE_PSU => 'PSU',
        self::TYPE_CASE => 'Case',
        self::TYPE_MAINBOARD => 'Main board',
        self::TYPE_FAN => 'Fan',
        self::TYPE_VGA => 'VGA',
    ];

    // Quan hệ với bảng Brand (nếu có)
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->hasOneThrough(Category::class, Product::class, 'detail_id', 'id', 'detail_id', 'category_id');
    }
    public function detail(){
        switch ($this->type){
            case Accessory::TYPE_RAM:
                return $this->belongsTo(Ram::class);

            case Accessory::TYPE_VGA:
                return $this->belongsTo(VGA::class);

            case Accessory::TYPE_PSU:
                return $this->belongsTo(PSU::class);

            case Accessory::TYPE_CPU:
                return $this->belongsTo(CPU::class);

            case Accessory::TYPE_MAINBOARD:
                return $this->belongsTo(MainBoard::class);

            case Accessory::TYPE_STORAGE:
                return $this->belongsTo(Storage::class);

            case Accessory::TYPE_FAN:
                return $this->belongsTo(Fan::class);
            case Accessory::TYPE_CASE:
                return $this->belongsTo(ComputerCase::class);
        }
    }
    public function product()
    {
        return $this->hasOne(Product::class, 'detail_id')->where('type', Product::TYPE_ACCESSORY);
    }
    public function deleteDependence(): void{
        $this->detail->delete();
    }
    public static function boot(): void
    {
        parent::boot();
        static::deleting(function($accessory){
            $accessory->deleteDependence();
        });
    }
    public static function fillDetailAccessoryByType($accessory_type, $data, $accessoryDetail){
        switch ($accessory_type){
            case Accessory::TYPE_MAINBOARD:
                MainBoard::fillDataMainBoard($data, $accessoryDetail);
                return $accessoryDetail;
            case Accessory::TYPE_CPU:
                CPU::fillDataCPU($data, $accessoryDetail);
                return $accessoryDetail;
            case Accessory::TYPE_RAM:
                Ram::fillDataRam($data, $accessoryDetail);
                return $accessoryDetail;
            case Accessory::TYPE_VGA:
                VGA::fillDataVGA($data, $accessoryDetail);
                return $accessoryDetail;
            case Accessory::TYPE_PSU:
                PSU::fillDataPSU($data, $accessoryDetail);
                return $accessoryDetail;
            case Accessory::TYPE_STORAGE:
                Storage::fillDataStorage($data, $accessoryDetail);
                return $accessoryDetail;
            case Accessory::TYPE_FAN:
                Fan::fillDataFan($data, $accessoryDetail);
                return $accessoryDetail;
            case Accessory::TYPE_CASE:
                ComputerCase::fillDataComputerCase($data, $accessoryDetail);
                return $accessoryDetail;
        }
    }
    public static function fillDataAccessory($input,$accessoryType, $accessory, $accessoryDetail){
        $accessory['brand_id'] = $input['brand_id'];
        $accessory['type'] = $accessoryType;
        $accessory['detail_id'] = $accessoryDetail->id;
        $accessory['dataSheet'] = $input['dataSheet'] ?? '';
        $accessory->save();
        return $accessory;
    }
    public static function getProductByType($type){
        return DB::table('accessories')
            ->join('products', 'accessories.id', '=', 'products.detail_id')
            ->where('accessories.type', $type)
            ->select('products.id', 'products.name')
            ->get();
    }
    public function scopeId($query, $filter){
        return !empty($filter) ? $query->where('id',$filter) : $query;
    }
    public function scopeName($query, $filter){
        return !empty($filter) ? $query->whereHas('product', function ($q) use ($filter) {
            $q->where('name', 'like', '%' . $filter . '%');
        }) : $query;
    }
    public function scopeBrand($query, $filter){
        return !empty($filter) ? $query->whereHas('brand', function ($q) use ($filter) {
            $q->where('name', 'like', '%' . $filter . '%');
        }) : $query;
    }
    public function scopeType($query, $filter){
        return !empty($filter) ? $query->where('type',$filter) : $query;
    }
}
