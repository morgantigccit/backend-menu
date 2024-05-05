<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Example Menu model (app/Models/Menu.php)
class Menu extends Model
{
// In your Menu model

protected $primaryKey = 'MenuItemID';

protected $fillable = [
    'category_id',
    'name',
    'description',
    "restaurant_name",
    'price',
    'image',
    // ... add any other column names you want to be mass-assignable
];
public function category() {

    return $this->belongsTo(Category::class, 'category_id', 'category_id');
}

}
