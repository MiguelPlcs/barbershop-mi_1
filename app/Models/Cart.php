<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // Usar el modelo compatible con MongoDB

class Cart extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'carts';
    protected $fillable = ['user_id'];

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
}
