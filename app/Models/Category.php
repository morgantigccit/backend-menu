<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'name',
        'image',
        'restaurant_name',
        'status',
        'slug',
        'description',
        // ... add other column names you want to be mass-assignable
    ];
}
