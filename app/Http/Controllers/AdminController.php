<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Mostrar el dashboard del admin con resumen de productos.
     */
    public function dashboard()
    {
        $productosCount = Producto::count();
        $recentProductos = Producto::orderBy('_id', 'desc')->take(6)->get();

        return view('admin.dashboard', compact('productosCount', 'recentProductos'));
    }
}
