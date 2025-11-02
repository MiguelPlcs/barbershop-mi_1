<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    // Catálogo público
    public function public()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $productos = Producto::paginate(9); // O la cantidad que prefieras por página
        return view('productos.public', compact('productos'));
    }

    // Catálogo para usuarios autenticados (rol user)
    public function user()
    {
        if (!Auth::check() || Auth::user()->role !== 'user') {
            abort(403, 'No autorizado');
        }

        $productos = Producto::paginate(9); // O la cantidad que prefieras por página
        return view('productos.user', compact('productos'));
    }

    // Comprar producto (solo user)
    public function comprar(Request $request, Producto $producto)
    {
        if ($producto->stock > 0) {
            $producto->stock -= 1;
            $producto->save();
            return redirect()->back()->with('success', '¡Compra realizada con éxito!');
        }
        return redirect()->back()->with('error', 'Producto sin stock.');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }
}
