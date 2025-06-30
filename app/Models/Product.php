<?php

namespace App\Models;

use Database\Seeders\LaptopAndPrebuiltPCSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'name', 'slug', 'type', 'cost', 'price', 'discount_type', 'discount_value',
        'images', 'post_id', 'category_id', 'detail_id'
    ];

    const TYPE_PC = 'PC';
    const TYPE_ACCESSORY = 'ACCESSORY';
    const TYPE_LAPTOP = 'LAPTOP';
    const TYPE_CUSTOM_PC = 'CUSTOM_PC';
    public static $listType = [
        self::TYPE_PC => 'PC',
        self::TYPE_ACCESSORY => 'Linh kiện',
        self::TYPE_LAPTOP => 'Laptop',
        self::TYPE_CUSTOM_PC => 'Custom PC',
    ];
    // Define relationships (if applicable)
    const DISCOUNT_PERCENT = 1;
    const DISCOUNT_VND = 99;
    public static $listDiscount = [
        self::DISCOUNT_PERCENT => 'Phần Trăm',
        self::DISCOUNT_VND => 'VNĐ',
    ];
    const NORMAL = 0;
    const FEATURED = 1;
    public static $listSuggest = [
        self::NORMAL => 'Sản phẩm thường',
        self::FEATURED => 'Nổi bật',
    ];
    // A product belongs to a post


    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // A product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    // A product belongs to a detail
    public function detail()
    {
        if ($this->type === 'PC') {
            return $this->belongsTo(LaptopAndPrebuiltPc::class, 'detail_id')
                ->where('product_type', LaptopAndPrebuiltPc::TYPE_PC);
        } elseif ($this->type === 'ACCESSORY') {
            return $this->belongsTo(Accessory::class, 'detail_id');
        } elseif ($this->type === 'LAPTOP') {
            return $this->belongsTo(LaptopAndPrebuiltPc::class, 'detail_id')
                ->where('product_type', LaptopAndPrebuiltPc::TYPE_LAPTOP);
        } elseif ($this->type === 'CUSTOM_PC') {
            return $this->belongsTo(CustomPc::class, 'detail_id');
        }
        return null;
    }
    public function deleteDependence(): void{
            $this->detail->delete();
    }
    public static function boot(): void
    {
        parent::boot();
        static::deleting(function($product){
            $product->deleteDependence();
        });
    }
    public function scopeId($query, $filter){
       return !empty($filter) ? $query->where('id', $filter) : $query;
    }
    public function scopeName($query, $filter){
        return !empty($filter) ? $query->where('name', 'like', "%$filter%") : $query;
    }
}

