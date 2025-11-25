<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;

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
        // Check stock
        if (isset($producto->stock) && $producto->stock <= 0) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Producto agotado.'], 400);
            }
            return redirect()->back()->with('error', 'Producto sin stock.');
        }

        $id = (string) ($producto->_id ?? $producto->id);

        if (Auth::check()) {
            // Persist cart in DB for authenticated users
            $cartModel = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $item = CartItem::where('cart_id', $cartModel->id)->where('producto_id', $id)->first();
            if ($item) {
                // Increment but clamp to available stock (allow adding up to full stock)
                $desired = $item->qty + $qty;
                if (isset($producto->stock)) {
                    $clamped = min($desired, (int)$producto->stock);
                    $item->qty = $clamped;
                    $item->save();
                    if ($clamped < $desired) {
                        $clampedMessage = 'La cantidad se ha ajustado al stock disponible.';
                    }
                } else {
                    $item->qty = $desired;
                    $item->save();
                }
            } else {
                if (isset($producto->stock) && $qty > $producto->stock) {
                    // If the requested qty exceeds stock, clamp to stock and create the item
                    $qty = (int) $producto->stock;
                    $clampedMessage = 'La cantidad se ha ajustado al stock disponible.';
                }
                $item = CartItem::create([
                    'cart_id' => $cartModel->id,
                    'producto_id' => $id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio,
                    'qty' => $qty,
                ]);
            }

            // Build response from DB items
            $items = [];
            $totalItems = 0;
            $totalPrice = 0;
            foreach ($cartModel->items as $c) {
                $subtotal = $c->precio * $c->qty;
                $totalItems += $c->qty;
                $totalPrice += $subtotal;
                $items[] = [
                    'id' => $c->id,
                    'producto_id' => $c->producto_id,
                    'nombre' => $c->nombre,
                    'precio' => $c->precio,
                    'qty' => $c->qty,
                    'subtotal' => $subtotal,
                ];
            }

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Producto añadido al carrito.', 'items' => $items, 'total_items' => $totalItems, 'total_price' => $totalPrice]);
            }

            return redirect()->back()->with('success', 'Producto añadido al carrito.');
        }

        // Guest: keep in session
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            $desired = $cart[$id]['qty'] + $qty;
            if (isset($producto->stock)) {
                $clamped = min($desired, (int)$producto->stock);
                $cart[$id]['qty'] = $clamped;
                if ($clamped < $desired) {
                    $clampedMessage = 'La cantidad se ha ajustado al stock disponible.';
                }
            } else {
                $cart[$id]['qty'] = $desired;
            }
        } else {
            if (isset($producto->stock) && $qty > $producto->stock) {
                $qty = (int)$producto->stock;
                $clampedMessage = 'La cantidad se ha ajustado al stock disponible.';
            }
            $cart[$id] = ['producto_id' => $id, 'nombre' => $producto->nombre, 'precio' => $producto->precio, 'qty' => $qty, 'imagen' => $producto->imagen ?? null];
        }
        session(['cart' => $cart]);

        // Si la petición espera JSON (AJAX), devolver resumen del carrito
        if ($request->wantsJson() || $request->ajax()) {
            $totalItems = 0;
            $totalPrice = 0;
            $items = [];
            foreach ($cart as $c) {
                $totalItems += $c['qty'];
                $subtotal = $c['precio'] * $c['qty'];
                $totalPrice += $subtotal;
                $items[] = [
                    'producto_id' => $c['producto_id'],
                    'nombre' => $c['nombre'],
                    'precio' => $c['precio'],
                    'qty' => $c['qty'],
                    'subtotal' => $subtotal,
                ];
            }

            $response = [
                'success' => true,
                'message' => 'Producto añadido al carrito.',
                'total_items' => $totalItems,
                'total_price' => $totalPrice,
                'items' => $items,
            ];
            if (!empty($clampedMessage)) $response['message'] = $clampedMessage;
            return response()->json($response);
        }

        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }

    // Ver carrito
    public function cart()
    {
        // Si el usuario está autenticado, cargar carrito persistente desde la BD
        if (Auth::check()) {
            $cartModel = Cart::with('items')->where('user_id', Auth::id())->first();
            $cart = [];
            if ($cartModel) {
                foreach ($cartModel->items as $item) {
                    $cart[$item->producto_id ?? $item->id] = [
                        'producto_id' => $item->producto_id,
                        'nombre' => $item->nombre,
                        'precio' => $item->precio,
                        'qty' => $item->qty,
                    ];
                }
            }
            return view('cart.index', compact('cart'));
        }

        // Invitado: carrito en sesión
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Mostrar formulario de ingreso de datos de pago (usuario autenticado)
    public function paymentForm(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cartModel = Cart::with('items')->where('user_id', Auth::id())->first();
        $cart = [];
        $total = 0;
        if ($cartModel) {
            foreach ($cartModel->items as $item) {
                $subtotal = $item->precio * $item->qty;
                $total += $subtotal;
                $cart[] = [
                    'producto_id' => $item->producto_id,
                    'nombre' => $item->nombre,
                    'precio' => $item->precio,
                    'qty' => $item->qty,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('cart.payment', compact('cart', 'total'));
    }

    // Mostrar página de confirmación de la orden creada
    public function confirmation($order)
    {
        $order = Order::find($order);
        if (!$order) {
            return redirect()->route('productos.public')->with('error', 'Orden no encontrada.');
        }
        // Asegurar que el usuario logueado es el dueño
        if ($order->user_id && Auth::check() && $order->user_id !== Auth::id()) {
            return redirect()->route('productos.public')->with('error', 'No autorizado para ver esta orden.');
        }

        return view('cart.confirmation', compact('order'));
    }

    // Procesar pago simulado: crear orden, decrementar stock y vaciar carrito persistente
    public function processPayment(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cartModel = Cart::with('items')->where('user_id', Auth::id())->first();
        if (!$cartModel || $cartModel->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }

        // Construir items de la orden y verificar stock
        $orderItems = [];
        $total = 0;
        foreach ($cartModel->items as $item) {
            $producto = Producto::find($item->producto_id);
            if (!$producto) {
                return redirect()->route('cart.index')->with('error', "Producto {$item->nombre} no encontrado.");
            }
            $qty = $item->qty;
            if (isset($producto->stock) && $producto->stock >= $qty) {
                $subtotal = $producto->precio * $qty;
                $orderItems[] = [
                    'producto_id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio,
                    'qty' => $qty,
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            } else {
                return redirect()->route('cart.index')->with('error', "Stock insuficiente para {$producto->nombre}.");
            }
        }

        // Crear orden (simulada) y almacenar datos de pago (simulación)
        $orderNumber = strtoupper('ORD-' . substr(uniqid(), -8));
        $payerName = $request->input('payer_name');
        $paymentMethod = $request->input('payment_method');
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => $orderNumber,
            'items' => $orderItems,
            'total' => $total,
            'payer_name' => $payerName,
            'payment_method' => $paymentMethod,
        ]);

        // Descontar stock
        foreach ($cartModel->items as $item) {
            $producto = Producto::find($item->producto_id);
            $producto->stock -= $item->qty;
            $producto->save();
        }

        // Eliminar items y carrito
        $cartModel->items()->delete();
        $cartModel->delete();

        return redirect()->route('cart.confirmation', ['order' => $order->id])->with('success', 'Compra realizada con éxito.');
    }

    // Generar vista de factura para invitado (sin registro)
    public function guestInvoice(Request $request)
    {
        $cart = session('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item['precio'] * $item['qty']);
        }

        return view('cart.guest_invoice', compact('cart', 'total'));
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
