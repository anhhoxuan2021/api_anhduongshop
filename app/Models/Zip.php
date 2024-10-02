<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zip extends Model
{
    use HasFactory;
    protected $table = 'zips';
    protected $primaryKey = 'id';
    protected $fillable = [
        'state',
        'city',
        'zip'
    ];
}
