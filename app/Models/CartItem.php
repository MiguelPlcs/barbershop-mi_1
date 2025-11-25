<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class CartItem extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'cart_items';
    protected $fillable = ['cart_id', 'producto_id', 'nombre', 'precio', 'qty'];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}
