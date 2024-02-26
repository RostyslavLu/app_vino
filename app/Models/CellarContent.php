<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CellarContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'cellars_id',
        'saq_wines_id',
        'personal_wines_id',
        'quantity',
        'vintage',
        'notes',
    ];
}
