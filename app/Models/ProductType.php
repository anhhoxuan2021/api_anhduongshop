<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $table = 'product_types';
    protected $primaryKey = 'prd_type_id';
    protected $fillable = [
        'prd_type_brand',
        'prd_type_name',
        'provider'
    ];
}
