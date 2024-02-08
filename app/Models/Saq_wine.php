<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saq_wine extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code_wine',
        'url',
        'url_image',
        'description',
        'price',
        'format',
        'regulated_designation',
        'country',
        'region',
        'grape_varieties',
        'degree_alcohol',
        'sugar_content'
    ];
}
