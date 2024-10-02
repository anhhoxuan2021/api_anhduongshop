<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'subject_mark'=>'array',
        'test4'=>'array'
    ];

    protected $casts = [
        'subject_mark'=>'array',
        'test4'=>'array'
    ];
}
