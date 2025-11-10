<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Return cart data as JSON (DB for auth, session for guests)
    public function data(Request $request)
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $items = [];
            $totalItems = 0;
            $totalPrice = 0;
            foreach ($cart->items as $c) {
                $subtotal = $c->precio * $c->qty;
                $totalItems += $c->qty;
                $totalPrice += $subtotal;
                // Try to fetch current stock from Producto
                $max = null;
                try {
                    $prod = Producto::find($c->producto_id);
                    if ($prod && isset($prod->stock)) $max = (int)$prod->stock;
                } catch (\Exception $e) {
                    $max = null;
                }

                $items[] = [
                    'id' => $c->id,
                    'producto_id' => $c->producto_id,
                    'nombre' => $c->nombre,
                    'precio' => $c->precio,
                    'qty' => $c->qty,
                    'subtotal' => $subtotal,
                    'max' => $max,
                ];
            }
            return response()->json(['items' => $items, 'total_items' => $totalItems, 'total_price' => $totalPrice]);
        }

        $sessionCart = session('cart', []);
        $items = [];
        $totalItems = 0;
        $totalPrice = 0;
        foreach ($sessionCart as $c) {
            $subtotal = $c['precio'] * $c['qty'];
            $totalItems += $c['qty'];
            $totalPrice += $subtotal;
            $max = null;
            try {
                $prod = Producto::find($c['producto_id']);
                if ($prod && isset($prod->stock)) $max = (int)$prod->stock;
            } catch (\Exception $e) {
                $max = null;
            }
            $items[] = ['producto_id' => $c['producto_id'], 'nombre' => $c['nombre'], 'precio' => $c['precio'], 'qty' => $c['qty'], 'subtotal' => $subtotal, 'max' => $max];
        }
        return response()->json(['items' => $items, 'total_items' => $totalItems, 'total_price' => $totalPrice]);
    }

    // Update quantity of a cart item (by cart_item id for auth, by producto_id for session)
    public function update(Request $request, $identifier)
    {
        $qty = max(1, (int) $request->input('qty', 1));

        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $item = CartItem::where('cart_id', $cart->id)->where('id', $identifier)->first();
            if (!$item) {
                return response()->json(['success' => false, 'message' => 'Item no encontrado'], 404);
            }
            $producto = Producto::find($item->producto_id);
            if ($producto && isset($producto->stock) && $qty > $producto->stock) {
                return response()->json(['success' => false, 'message' => 'Stock insuficiente'], 400);
            }
            $item->qty = $qty;
            $item->save();
            return $this->data($request);
        }

        // session: identifier is producto_id
        $cart = session('cart', []);
        if (!isset($cart[$identifier])) {
            return response()->json(['success' => false, 'message' => 'Item no encontrado'], 404);
        }
        $producto = Producto::find($identifier);
        if ($producto && isset($producto->stock) && $qty > $producto->stock) {
            return response()->json(['success' => false, 'message' => 'Stock insuficiente'], 400);
        }
        $cart[$identifier]['qty'] = $qty;
        session(['cart' => $cart]);
        return $this->data($request);
    }

    // Remove an item
    public function destroy(Request $request, $identifier)
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $item = CartItem::where('cart_id', $cart->id)->where('id', $identifier)->first();
            if ($item) $item->delete();
            return $this->data($request);
        }

        $cart = session('cart', []);
        if (isset($cart[$identifier])) {
            unset($cart[$identifier]);
            session(['cart' => $cart]);
        }
        return $this->data($request);
    }
}
