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
        $orders = \App\Models\Order::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.orders', compact('orders'));
    }

    /**
     * Actualizar estado del pedido
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pendiente,Confirmado,Enviado,Punto de entrega fisico,Cancelado'
        ]);

        $order = \App\Models\Order::findOrFail($id);

        if ($order->status !== 'Cancelado' && $request->status === 'Cancelado') {
            foreach ($order->items as $item) {
                $producto = \App\Models\Producto::find($item['producto_id']);
                if ($producto && isset($producto->stock)) {
                    $producto->stock += $item['qty'];
                    $producto->save();
                }
            }
        }

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Estado del pedido actualizado correctamente.');
    }

    /**
     * Gestionar envíos
     */
    public function shipments()
    {
        $orders = \App\Models\Order::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.shipments', compact('orders'));
    }

    /**
     * Gestionar devoluciones
     */
    public function returns()
    {
        $orders = \App\Models\Order::with('user')->where('status', 'Cancelado')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.returns', compact('orders'));
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
