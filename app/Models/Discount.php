<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discounts';
    protected $fillable = [
        'discount_code',
        'discount_type',
        'discount_amount',
        'start_date',
        'end_date'
    ];

    protected $guarded = [
        'app_total'];
}
