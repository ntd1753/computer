<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name', 'slug', 'type', 'cost', 'price', 'discount_type', 'discount_value',
        'images', 'post_id', 'category_id', 'detail_id'
    ];

    // Cast images field to JSON array for easier manipulation
    protected $casts = [
        'images' => 'array', // This will automatically decode the JSON into an array
    ];
    const TYPE_PC = 'PC';
    const TYPE_ACCESSORY = 'ACCESSORY';
    public static $listType = [
        self::TYPE_PC => 'PC',
        self::TYPE_ACCESSORY => 'Linh kiện',
    ];
    // Define relationships (if applicable)
    const DISCOUNT_PERCENT = 1;
    const DISCOUNT_VND = 99;
    public static $listDiscount = [
        self::DISCOUNT_PERCENT => 'Phần Trăm',
        self::DISCOUNT_VND => 'VNĐ',
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

    // A product belongs to a detail
    public function detail()
    {
        if ($this->type === 'PC') {
            return $this->belongsTo(PC::class, 'detail_id');
        } elseif ($this->type === 'ACCESSORY') {
            return $this->belongsTo(Accessory::class, 'detail_id');
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
}

