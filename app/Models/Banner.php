<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    // Tên bảng (nếu không đặt, Laravel sẽ tự động lấy tên số nhiều từ model)
    protected $table = 'banners';

    // Các cột có thể gán giá trị hàng loạt (Mass Assignment)
    protected $fillable = [
        'title',
        'link',
        'image',
        'position',
        'status',
    ];
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 99;
    public static $listStatus = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopePosition($query, $filter)
    {
        return !empty($filter) ? $query->where('position', $filter) : $query;
    }

}
