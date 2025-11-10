{{-- filepath: resources/views/productos/public.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Catálogo de Productos
        </h2>
    </x-slot>
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse($productos as $producto)
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-lg hover:shadow-2xl transition p-6 flex flex-col items-center">
                        {{-- Si tienes imagen: --}}
                        @if($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-32 h-32 object-cover rounded-full mb-4 shadow">
                        @else
                            <div class="w-32 h-32 flex items-center justify-center bg-gray-100 rounded-full mb-4 text-gray-400 text-4xl">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        <h4 class="text-lg font-bold mb-2 text-gray-800 text-center">{{ $producto->nombre }}</h4>
                        <p class="text-gray-600 mb-2 text-center">{{ $producto->descripcion }}</p>
                        <span class="text-indigo-700 font-extrabold text-lg mb-2 block text-center">${{ number_format($producto->precio, 0, ',', '.') }}</span>
                        <span class="text-xs text-gray-500 mb-4 block text-center">Stock: {{ $producto->stock }}</span>
                        <div class="flex gap-2 mt-auto w-full justify-center">
                            <a href="{{ route('productos.show', $producto->_id) }}" class="btn btn-secondary">Ver detalle</a>

                            <form action="{{ route('cart.add', $producto->_id) }}" method="POST" class="inline-block">
                                @csrf
                                <input type="hidden" name="qty" value="1">
                                <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500">
                        No hay productos disponibles.
                    </div>
                @endforelse
            </div>
            <div class="mt-8 flex justify-center">
                {{ $productos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>