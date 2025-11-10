<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Carrito</h2>
    </x-slot>

    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">Tu carrito</h3>

                @if(empty($cart))
                    <p class="text-gray-600">Tu carrito está vacío.</p>
                @else
                    <table class="w-full text-left">
                        <thead>
                            <tr>
                                <th class="pb-2">Producto</th>
                                <th class="pb-2">Precio</th>
                                <th class="pb-2">Cantidad</th>
                                <th class="pb-2">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $total = 0; @endphp
                        @foreach($cart as $item)
                            @php $subtotal = $item['precio'] * $item['qty']; $total += $subtotal; @endphp
                            <tr class="border-t">
                                <td class="py-3">{{ $item['nombre'] }}</td>
                                <td class="py-3">${{ number_format($item['precio'], 0, ',', '.') }}</td>
                                <td class="py-3">{{ $item['qty'] }}</td>
                                <td class="py-3">${{ number_format($subtotal, 0, ',', '.') }}</td>
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

                    <div class="mt-6 flex justify-end gap-3">
                        @if(Auth::check())
                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Proceder al pago</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Inicia sesión para pagar</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
