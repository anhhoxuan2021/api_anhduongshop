<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderView extends Model
{
    use HasFactory;
    protected $table = 'order_shipment_view';
    protected $primaryKey = 'order_id';
}
