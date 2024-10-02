<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table = 'order_products';
    protected $primaryKey = 'order_products_id';
    protected $fillable = [
        'order_order_id',
        'order_products_id',
        'order_product_qty',
        'order_product_price',
        'order_product_total',
        'order_product_price',
        'order_product_name',
        'order_product_regular_price',
        'order_product_color',
        'order_product_size',
        'order_product_sex'
    ];

    protected $guarded = [
    ];
}
