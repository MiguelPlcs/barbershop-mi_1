<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Gestión de Productos
        </h2>
    </x-slot>

    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-gray-800">Productos</h3>
                <a href="{{ route('admin.productos.create') }}" class="btn btn-success">
                    + Crear Producto
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse($productos as $producto)
                    <div class="bg-blue-100 border-2 border-blue-400 rounded-3xl shadow-xl hover:shadow-2xl transition p-6 flex flex-col">
                        <h4 class="text-xl font-bold mb-2 text-blue-900 text-center">{{ $producto->nombre }}</h4>
                        <p class="text-blue-800 mb-2 text-center">{{ $producto->descripcion }}</p>
                        <span class="text-blue-900 font-extrabold text-lg mb-4 block text-center">${{ number_format($producto->precio, 0, ',', '.') }}</span>
                        <span class="text-xs text-blue-700 mb-4 block text-center">Stock: {{ $producto->stock }}</span>
                        <div class="flex justify-center gap-2 mt-auto">
                            <a href="{{ route('admin.productos.edit', $producto->_id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('admin.productos.destroy', $producto->_id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500">
                        No hay productos registrados.
                    </div>
                @endforelse
            </div>
            <!-- Paginación -->
            <div class="mt-8 flex justify-center">
                {{ $productos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>