<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Barbería - Inicio</title>
    @vite('resources/css/home.css')
</head>
<body>
    {{-- filepath: resources/views/home.blade.php --}}
    <x-app-layout>
        <div class="flex items-center justify-center min-h-[90vh] bg-black">
            <div class="recuadro w-full max-w-5xl bg-gray-900/90 shadow-lg rounded-xl p-4 sm:p-8">
                <h1 class="text-3xl font-bold mb-4 text-center text-white">Bienvenido a Barbershop Miguel plcs</h1>
                <p class="info-parrafo text-center text-white">Dirección: Medrano-Choco-Quibdo-Colombia</p>
                <p class="info-parrafo text-center text-white">Teléfono: 3226569641</p>
                <p class="info-parrafo text-center text-white">Horario: Lunes a Sábado, 9:00am - 7:00pm</p>
                <p class="info-parrafo text-center mb-6 text-white">¡Ofrecemos los mejores cortes y productos para tu cuidado personal!</p>
                <div class="flex flex-wrap justify-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Panel de Administración</a>
                            @else
                                <a href="{{ route('productos.user') }}" class="btn btn-primary">Catálogo de Productos</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="btn btn-secondary ml-2">Cerrar sesión</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-secondary ml-2">Registrarse</a>
                            @endif
                        @endauth
                    @endif
                    <a href="{{ route('productos.public') }}" class="btn btn-primary ml-2">Ver Catálogo de Productos</a>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>