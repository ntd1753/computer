<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'total',
        'discount',
        'total_amount',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'order_status',
        'payment_status',
    ];
    const ORDER_STATUS_PENDING = 'PENDING';
    const ORDER_STATUS_PROCESSING = 'PROCESSING';
    const ORDER_STATUS_COMPLETED = 'COMPLETED';
    const ORDER_STATUS_CANCELLED = 'CANCELLED';
    const ORDER_STATUS_FAILED = 'FAILED';
    public static $statusColors = [
        self::ORDER_STATUS_PENDING => 'bg-warning', // Yellow
        self::ORDER_STATUS_PROCESSING => 'bg-info', // Blue
        self::ORDER_STATUS_COMPLETED => 'bg-success', // Green
        self::ORDER_STATUS_CANCELLED => 'bg-[#FF4500]', // Orange
        self::ORDER_STATUS_FAILED => 'bg-danger', // Red
    ];

    public static $listOrderStatus = [
        self::ORDER_STATUS_PENDING => 'Chờ xác nhận',
        self::ORDER_STATUS_PROCESSING => 'Đang giao hàng',
        self::ORDER_STATUS_COMPLETED => 'Hoàn tất',
        self::ORDER_STATUS_CANCELLED => 'Huỷ bỏ',
        self::ORDER_STATUS_FAILED => 'Thanh toán thất bại',

    ];

    const PAYMENT_STATUS_COMPLETED = 'COMPLETED';
    const PAYMENT_STATUS_FAILED = 'FAILED';
    const PAYMENT_STATUS_PENDING = 'PENDING';
    const PAYMENT_STATUS_COD = 'COD';
    const PAYMENT_STATUS_REFUNDED = 'REFUNDED';
    public static $listPaymentStatus = [
        self::PAYMENT_STATUS_PENDING => 'Chờ thanh toán',
        self::PAYMENT_STATUS_COMPLETED => 'Đã thanh toán',
        self::PAYMENT_STATUS_FAILED => 'Thanh toán thất bại',
        self::PAYMENT_STATUS_COD => 'Thanh toán khi nhận hàng',
        self::PAYMENT_STATUS_REFUNDED => 'Đã hoàn tiền',
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_id');
    }
    public function scopePaymentStatus($query, $filter)
    {
        return !empty($filter) ? $query->where('payment_status',$filter) : $query;
    }
    public function scopeOrderStatus($query, $filter)
    {
        return !empty($filter) ? $query->where('order_status',$filter) : $query;
    }
    public function scopeId($query, $filter)
    {
        return !empty($filter) ? $query->where('id',$filter) : $query;
    }
}
