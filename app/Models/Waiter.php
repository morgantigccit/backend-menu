<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'restaurant_name',
    ];


    public function tables()
    {
        return $this->hasMany(Table::class);
    }
}
