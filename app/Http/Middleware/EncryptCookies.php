<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    // Puedes agregar cookies que no quieras cifrar aquí
    protected $except = [
        //
    ];
}