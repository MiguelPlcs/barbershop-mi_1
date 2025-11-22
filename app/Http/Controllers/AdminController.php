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

    /**
     * Reporte de stock
     */
    public function stockReport()
    {
        return view('admin.stock-report');
    }

    /**
     * Atender pedidos
     */
    public function orders()
    {
        return view('admin.orders');
    }

    /**
     * Gestionar envíos
     */
    public function shipments()
    {
        return view('admin.shipments');
    }

    /**
     * Gestionar devoluciones
     */
    public function returns()
    {
        return view('admin.returns');
    }

    /**
     * Gestionar usuarios
     */
    public function users()
    {
        $users = \App\Models\User::paginate(20);
        return view('admin.users', compact('users'));
    }
}
