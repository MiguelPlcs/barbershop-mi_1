{{-- filepath: resources/views/admin/productos/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalle del Producto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3>{{ $producto->nombre }}</h3>
                <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                <p><strong>Precio:</strong> ${{ $producto->precio }}</p>
                <p><strong>Stock:</strong> {{ $producto->stock }}</p>
                @if($producto->imagen)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen del producto" width="200">
                    </div>
                @endif
                <div class="mt-4">
                    <a href="{{ route('admin.productos.edit', $producto->_id) }}" class="btn btn-warning">Editar</a>
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>