<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Example Payment model (app/Models/Payment.php)
class Payment extends Model
{
    protected $fillable = ['OrderID', 'Amount', 'PaymentStatus', 'PaymentMethod'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

