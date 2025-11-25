<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'order_number', 'items', 'total'];

    protected $casts = [
        'items' => 'array',
        'total' => 'decimal:2',
    ];
}
