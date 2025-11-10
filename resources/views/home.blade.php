<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Barbería - Inicio</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        // Pequeño script para controlar el carrusel horizontal
        function nextSlide() {
            const container = document.querySelector('.hero-carousel .slides');
            container.scrollBy({ left: container.offsetWidth, behavior: 'smooth' });
        }
        function prevSlide() {
            const container = document.querySelector('.hero-carousel .slides');
            container.scrollBy({ left: -container.offsetWidth, behavior: 'smooth' });
        }
        // accesibilidad: teclas ← → para navegar
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') nextSlide();
            if (e.key === 'ArrowLeft') prevSlide();
        });
    </script>
</head>
<body>
    {{-- filepath: resources/views/home.blade.php --}}
    <x-app-layout>
        <header class="site-header">
            <div class="container full header-inner">
                <div class="brand">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo" onerror="this.style.filter='grayscale(1)';"/>
                    </a>
                </div>
                <nav class="top-nav">
                    <a href="#">Inicio</a>
                    <a href="{{ route('productos.public') }}">Tienda</a>
                    <a href="#">Nosotros</a>
                    <a href="#">Contacto</a>
                </nav>
                <div class="header-actions">
                    @auth
                        <a href="{{ route('profile.edit') }}" class="btn-circle" title="Mi perfil">👤</a>
                    @else
                        <a href="{{ url('/login') }}" class="btn-circle" title="Iniciar sesión">👤</a>
                    @endauth
                    <a href="#" class="btn-circle cart" title="Carrito">🛒<span class="cart-count">0</span></a>
                </div>
            </div>
            <div class="container full search-row">
                <input type="text" placeholder="¿Qué estás buscando hoy?" class="search-input" />
            </div>
            <div class="container full pills-row">
                <div class="pills">
                    <a class="pill">Capas</a>
                    <a class="pill">Ceras</a>
                    <a class="pill">Máquinas</a>
                    <a class="pill">Patilleras</a>
                    <a class="pill">Tijeras</a>
                    <a class="pill">Barberas</a>
                    <a class="pill">Atomizadores</a>
                </div>
            </div>
        </header>

    <main class="container full main-content">
            <section class="hero-carousel">
                <button class="carousel-btn prev" aria-label="Anterior" onclick="prevSlide()">‹</button>
                <div class="slides">
                    <article class="hero-slide" style="background-image: linear-gradient(90deg, rgba(0,0,0,0.35), rgba(0,0,0,0.05)), url('{{ asset('images/slide-1.jpg') }}');">
                        <div class="hero-inner">
                            <h2>Ofertas Babyliss</h2>
                            <p class="hero-price">Ahora: <strong>$700.000</strong></p>
                        </div>
                    </article>
                    <article class="hero-slide" style="background-image: linear-gradient(90deg, rgba(0,0,0,0.35), rgba(0,0,0,0.05)), url('{{ asset('images/slide-2.jpg') }}');">
                        <div class="hero-inner">
                            <h2>Parabarberos está en tu ciudad</h2>
                            <p>Compra online y recibe hoy mismo</p>
                        </div>
                    </article>
                </div>
                <button class="carousel-btn next" aria-label="Siguiente" onclick="nextSlide()">›</button>
            </section>

            <div class="promo-strip">Domicilio gratis en <strong>Cali, Pasto, Tuluá y Medellín</strong></div>

            <section class="quick-links">
                <a class="card" href="{{ route('productos.public') }}">Ver catálogo</a>
                <a class="card" href="#">Ofertas</a>
                <a class="card" href="#">Novedades</a>
            </section>
        </main>

        <a class="whatsapp-float" href="https://wa.me/573226569641" target="_blank" rel="noopener">💬</a>

    </x-app-layout>
</body>
</html>