<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'order_code',
        'order_status',
        'order_total',
        'shipment',
        'order_discount_code',
        'order_discount_total',
        'user_id',
        'order_payment_method'
    ];
}
