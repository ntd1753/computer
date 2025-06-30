<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'rating', 'review_content', 'image_url', 'parent_id'
    ];

    const STATUS_PENDING = 'PENDING';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_REJECTED = 'REJECTED';
    public static $listStatus = [
        self::STATUS_PENDING => 'Chờ duyệt',
        self::STATUS_APPROVED => 'Đã duyệt',
        self::STATUS_REJECTED => 'Bị từ chối',
    ];
    public static $statusColors = [
        self::STATUS_PENDING => 'bg-warning',
        self::STATUS_APPROVED => 'bg-success',
        self::STATUS_REJECTED => 'bg-danger',
    ];
    // Quan hệ với người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Quan hệ trả lời bình luận (nếu có)
    public function parent()
    {
        return $this->belongsTo(Review::class, 'parent_id');
    }

    // Quan hệ các câu trả lời của một bình luận
    public function replies()
    {
        return $this->hasMany(Review::class, 'parent_id');
    }
    public function scopeStatus($query, $filter)
    {
        return !empty($filter) ? $query->where('status',$filter) : $query;
    }
}
