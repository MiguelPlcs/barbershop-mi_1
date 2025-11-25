<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'orders';

    protected $fillable = ['user_id', 'order_number', 'items', 'total', 'payer_name', 'payment_method'];

    protected $casts = [
        'items' => 'array',
        'total' => 'float',
    ];
}
