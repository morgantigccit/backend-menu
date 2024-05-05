<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Example Table model (app/Models/Table.php)
class Table extends Model
{
    protected $fillable = ['TableNumber', 'Status','restaurant_name'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function waiter()
    {
        return $this->belongsTo(Waiter::class, 'waiter_id');
    }
}

