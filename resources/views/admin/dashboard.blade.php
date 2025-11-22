{{-- filepath: c:\xampp\htdocs\Proyectos\Laravel\barbershop-mi_1\resources\views\admin\dashboard.blade.php --}}
<x-app-layout>
    {{-- Comprueba si hay usuario autenticado y su rol es 'admin' --}}
    @if(Auth::check() && Auth::user()->role === 'admin')
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Panel de Administración
            </h2>
        </x-slot>

        <div class="py-12 bg-white min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Opciones del panel administrador -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-6">
                    <a href="{{ route('admin.stock.report') }}" class="block p-4 bg-white border rounded-lg shadow hover:shadow-md">
                        <h4 class="font-semibold">Reporte de stock</h4>
                        <p class="text-sm text-gray-500">Ver niveles y alertas de inventario</p>
                    </a>

                    <a href="{{ route('admin.orders.index') }}" class="block p-4 bg-white border rounded-lg shadow hover:shadow-md">
                        <h4 class="font-semibold">Atender pedidos</h4>
                        <p class="text-sm text-gray-500">Revisar y procesar pedidos</p>
                    </a>

                    <a href="{{ route('admin.shipments.index') }}" class="block p-4 bg-white border rounded-lg shadow hover:shadow-md">
                        <h4 class="font-semibold">Gestionar envíos</h4>
                        <p class="text-sm text-gray-500">Seguimiento y estados de envío</p>
                    </a>

                    <a href="{{ route('admin.returns.index') }}" class="block p-4 bg-white border rounded-lg shadow hover:shadow-md">
                        <h4 class="font-semibold">Gestionar devoluciones</h4>
                        <p class="text-sm text-gray-500">Revisar solicitudes de devolución</p>
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="block p-4 bg-white border rounded-lg shadow hover:shadow-md">
                        <h4 class="font-semibold">Gestionar usuarios</h4>
                        <p class="text-sm text-gray-500">Crear, editar y asignar roles</p>
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Resumen -->
                    <div class="lg:col-span-1 bg-gray-900 shadow sm:rounded-lg p-6 text-white">
                        <h3 class="text-2xl font-bold mb-2">Bienvenido, administrador</h3>
                        <p class="text-gray-200 mb-4">Desde aquí puedes gestionar los productos del sistema.</p>
                        <div class="mb-4">
                            <span class="block text-sm text-gray-300">Productos registrados</span>
                            <span class="text-3xl font-extrabold">{{ $productosCount ?? 0 }}</span>
                        </div>
                        <a href="{{ route('admin.productos.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Ir a la gestión de productos
                        </a>
                    </div>

                    <!-- Últimos productos -->
                    <div class="lg:col-span-2">
                        <div class="bg-white shadow sm:rounded-lg p-6">
                            <h4 class="text-xl font-bold mb-4">Últimos productos</h4>
                            @if(isset($recentProductos) && $recentProductos->isNotEmpty())
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                    @foreach($recentProductos as $p)
                                        <div class="border rounded-lg overflow-hidden shadow-sm flex flex-col">
                                            <div class="p-4 flex-1">
                                                <h5 class="font-semibold text-gray-800">{{ $p->nombre }}</h5>
                                                <p class="text-sm text-gray-600 mt-1">{{ \Illuminate\Support\Str::limit($p->descripcion ?? '', 80) }}</p>
                                            </div>
                                            <div class="p-4 bg-gray-50 flex items-center justify-between">
                                                <span class="font-bold text-gray-800">${{ number_format($p->precio, 0, ',', '.') }}</span>
                                                <a href="{{ route('admin.productos.edit', $p->_id ?? $p->id ?? $p) }}" class="text-sm text-blue-600 hover:underline">Editar</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-600">No hay productos recientes.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Vista para usuarios sin permisos --}}
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Acceso denegado
            </h2>
        </x-slot>

        <div class="py-12 bg-white min-h-screen">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-red-600 shadow-lg sm:rounded-lg p-8 text-white">
                    <h3 class="text-2xl font-bold mb-2">Acceso denegado</h3>
                    <p class="mb-4">No tienes permisos para acceder al panel de administración.</p>
                    <a href="{{ url('/') }}" class="btn btn-secondary mt-4 text-white">
                        Volver al inicio
                    </a>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>