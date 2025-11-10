{{-- filepath: resources/views/admin/productos/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Producto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.productos.update', $producto->_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="input" value="{{ old('nombre', $producto->nombre) }}" required>
                    </div>
                    <div class="mb-4">
                        <label>Descripción:</label>
                        <textarea name="descripcion" class="input" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label>Precio:</label>
                        <input type="number" name="precio" class="input" step="0.01" value="{{ old('precio', $producto->precio) }}" required>
                    </div>
                    <div class="mb-4">
                        <label>Stock:</label>
                        <input type="number" name="stock" class="input" min="0" value="{{ old('stock', $producto->stock) }}" required>
                    </div>
                    <div class="mb-4">
                        <label>Imagen:</label>
                        <input type="file" name="imagen" class="input">
                        @if($producto->imagen)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen actual" width="100">
                            </div>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label>Categoría:</label>
                        <input list="categorias-list" name="categoria" class="input" value="{{ old('categoria', $producto->categoria ?? '') }}" placeholder="Ej: Capas, Ceras, Máquinas">
                        <datalist id="categorias-list">
                            @if(isset($categorias))
                                @foreach($categorias as $c)
                                    <option value="{{ $c }}"></option>
                                @endforeach
                            @endif
                        </datalist>
                    </div>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>