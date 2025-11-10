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
        // Compra directa (simulada): decrementa stock en 1
        if (isset($producto->stock) && $producto->stock > 0) {
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

    // Añadir al carrito (sesión)
    public function addToCart(Request $request, Producto $producto)
    {
        $qty = max(1, (int) $request->input('qty', 1));
        $cart = session('cart', []);
        $id = (string) ($producto->_id ?? $producto->id);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += $qty;
        } else {
            $cart[$id] = [
                'producto_id' => $id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'qty' => $qty,
                'imagen' => $producto->imagen ?? null,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }

    // Ver carrito
    public function cart()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Simular checkout: decrementar stock si disponible y vaciar carrito
    public function checkout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        foreach ($cart as $item) {
            $producto = Producto::find($item['producto_id']);
            if (!$producto) {
                return redirect()->back()->with('error', "Producto {$item['nombre']} no encontrado.");
            }
            $qty = $item['qty'];
            if (isset($producto->stock) && $producto->stock >= $qty) {
                $producto->stock -= $qty;
                $producto->save();
            } else {
                return redirect()->back()->with('error', "Stock insuficiente para {$producto->nombre}.");
            }
        }

        // Vaciar carrito y simular éxito
        session()->forget('cart');
        return redirect()->route('productos.public')->with('success', 'Compra simulada completada.');
    }
}
