<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'prd_id';
    protected $fillable = [
       // 'prd_batch_code',
        'prd_type',
        'prd_name',
        'prd_sku',
        'prd_quantity',
        'prd_disctiption',
        'prod_special_point',
        'prd_sex',
        'prod_size_inch',
       // 'prd_tag',
        //'prd_similar',
        'prod_attr',
        'image_present',
        'prd_suggest'
    ];

    protected $guarded = ['prd_short_disctiption',
        'prd_brand_id',
        'prd_tag',];

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }
}
