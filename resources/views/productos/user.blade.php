{{-- filepath: resources/views/productos/user.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Catálogo de Productos (Usuario registrado)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="alert alert-success mb-4">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
                    @endif

                    @foreach($productos as $producto)
                        <div class="mb-4 border-b pb-2">
                            <h3>{{ $producto->nombre }}</h3>
                            <p>{{ $producto->descripcion }}</p>
                            <p>Precio: ${{ $producto->precio }}</p>
                            <p>Stock: {{ $producto->stock }}</p>
                            <form action="{{ route('productos.comprar', $producto->_id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Comprar</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>