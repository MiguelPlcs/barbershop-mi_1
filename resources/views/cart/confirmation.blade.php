<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Confirmación de la compra</h2>
    </x-slot>

    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">Gracias por tu compra</h3>

                <p class="mb-4">Número de orden: <strong>{{ $order->order_number }}</strong></p>

                <table class="w-full text-left mb-6">
                    <thead>
                        <tr>
                            <th class="pb-2">Producto</th>
                            <th class="pb-2">Precio</th>
                            <th class="pb-2">Cantidad</th>
                            <th class="pb-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr class="border-t">
                                <td class="py-3">{{ $item['nombre'] }}</td>
                                <td class="py-3">${{ number_format($item['precio'], 0, ',', '.') }}</td>
                                <td class="py-3">{{ $item['qty'] }}</td>
                                <td class="py-3">${{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="border-t">
                            <td colspan="3" class="py-3 font-bold">Total</td>
                            <td class="py-3 font-bold">${{ number_format($order->total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('productos.public') }}" class="btn btn-secondary cart-btn-blue">Seguir comprando</a>
                    <button onclick="window.print();" class="btn btn-primary cart-btn-blue">Imprimir comprobante</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
