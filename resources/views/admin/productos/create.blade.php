{{-- filepath: resources/views/admin/productos/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Crear Producto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="input" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="mb-4">
                        <label>Descripción:</label>
                        <textarea name="descripcion" class="input" required>{{ old('descripcion') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label>Precio:</label>
                        <input type="number" name="precio" class="input" step="0.01" value="{{ old('precio') }}" required>
                    </div>
                    <div class="mb-4">
                        <label>Stock:</label>
                        <input type="number" name="stock" class="input" min="0" value="{{ old('stock') }}" required>
                    </div>
                    <div class="mb-4">
                        <label>Imagen:</label>
                        <input type="file" name="imagen" class="input">
                    </div>
                    <button type="submit" class="btn btn-success">Crear</button>
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>