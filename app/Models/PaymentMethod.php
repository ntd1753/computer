<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'info'
    ];
    const PAYMENT_METHOD_COD = 'COD';
    const PAYMENT_METHOD_VNPAY = 'VNPAY';
    const PAYMENT_METHOD_MOMO = 'MOMO';

    public function orders()
    {
        return $this->hasMany(Order::class, 'payment_id');
    }
}
