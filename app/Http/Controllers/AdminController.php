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

        $validOrders = \App\Models\Order::with('user')->where('status', '!=', 'Cancelado')->orderBy('created_at', 'desc')->get();
        
        $totalGanancias = $validOrders->sum('total');
        $productosVendidos = 0;
        $soldItemsDetails = collect();

        foreach ($validOrders as $order) {
            if (is_array($order->items)) {
                foreach ($order->items as $item) {
                    $productosVendidos += $item['qty'] ?? 1;
                    $soldItemsDetails->push((object)[
                        'order_number' => $order->order_number ?? substr($order->_id, -8),
                        'order_id' => $order->_id,
                        'user_name' => $order->payer_name ?? ($order->user->name ?? 'Invitado'),
                        'product_name' => $item['nombre'] ?? 'Producto Desconocido',
                        'qty' => $item['qty'] ?? 1,
                        'price' => $item['precio'] ?? 0,
                        'date' => $order->created_at,
                    ]);
                }
            }
        }

        // Limitar a los 20 más recientes para la vista rápida
        $soldItemsDetails = $soldItemsDetails->take(20);

        return view('admin.dashboard', compact('productosCount', 'recentProductos', 'totalGanancias', 'productosVendidos', 'soldItemsDetails'));
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
