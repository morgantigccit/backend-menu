<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Assuming your database columns are in snake_case
    protected $fillable = ['order_id', 'MenuItemID', 'quantity','restaurant_name'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id'); // Correcting the foreign key if needed
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'MenuItemID'); // Correcting the custom foreign key
    }

}
