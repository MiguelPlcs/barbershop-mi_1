<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ingreso de datos de pago</h2>
    </x-slot>

    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">Ingresar datos de pago</h3>

                @if(session('error'))
                    <div class="text-red-600 mb-4">{{ session('error') }}</div>
                @endif

                @if(empty($cart))
                    <p class="text-gray-600">No hay productos en el carrito.</p>
                @else
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
                        @foreach($cart as $item)
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
                                <td class="py-3 font-bold">${{ number_format($total, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <form action="{{ route('cart.process_payment') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            <input name="payer_name" placeholder="Nombre completo" class="border p-2 rounded" required />
                            <select name="payment_method" class="border p-2 rounded" required>
                                <option value="">Selecciona método de pago</option>
                                <option value="tarjeta">Tarjeta</option>
                                <option value="efectivo">Efectivo</option>
                                <option value="transferencia">Transferencia</option>
                            </select>
                        </div>

                        <div class="mt-4 flex justify-end gap-3">
                            <a href="{{ route('cart.index') }}" class="btn btn-secondary cart-btn-blue">Volver al carrito</a>
                            <button type="submit" class="btn btn-primary cart-btn-blue">Pagar y finalizar compra</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
