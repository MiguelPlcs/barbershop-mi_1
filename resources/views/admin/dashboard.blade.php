{{-- filepath: resources/views/admin/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de Administración
        </h2>
    </x-slot>
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 shadow-lg sm:rounded-lg p-8">
                <h3 class="text-2xl font-bold text-white mb-2">Bienvenido, administrador</h3>
                <p class="text-gray-200 mb-4">Desde aquí puedes gestionar los productos del sistema.</p>
                <a href="{{ route('admin.productos.index') }}" class="btn btn-primary mt-4 text-white">
                    Ir a la gestión de productos
                </a>
            </div>
        </div>
    </div>
</x-app-layout>