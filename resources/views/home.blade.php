<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Barbershop</title>
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

        // Filtrado por categoría: cuando el usuario hace click en una "pill" mostrar solo slides de esa categoría
        document.addEventListener('DOMContentLoaded', function () {
            function setupCategoryFilters() {
                const pills = document.querySelectorAll('.pills .pill');
                const slidesContainer = document.querySelector('.hero-carousel .slides');
                if (!pills.length || !slidesContainer) return;

                const slides = () => Array.from(slidesContainer.querySelectorAll('.hero-slide'));

                pills.forEach(pill => {
                    pill.addEventListener('click', function (e) {
                        e.preventDefault();
                        const cat = this.dataset.category || this.textContent.trim();
                        pills.forEach(p => p.classList.remove('active'));
                        this.classList.add('active');

                        if (cat === 'all') {
                            slides().forEach(s => s.classList.remove('hidden-slide'));
                            const first = slides()[0];
                            if (first) first.scrollIntoView({ behavior: 'smooth', inline: 'start' });
                            return;
                        }

                        let firstVisible = null;
                        slides().forEach(s => {
                            const sCat = (s.dataset.category || '').toString();
                            if (sCat === cat) {
                                s.classList.remove('hidden-slide');
                                if (!firstVisible) firstVisible = s;
                            } else {
                                s.classList.add('hidden-slide');
                            }
                        });

                        if (firstVisible) firstVisible.scrollIntoView({ behavior: 'smooth', inline: 'start' });
                    });
                });
            }

            setupCategoryFilters();
        });
    </script>
    <style>
        /* Estilos mínimos para el filtrado */
        .hidden-slide { display: none !important; }
        /* Separación entre pills y otros elementos */
        .pills { margin: 1rem 0; }
        /* Espacio entre cada pill y estilos básicos */
        .pills .pill { margin-right: 0.5rem; padding: 0.35rem 0.6rem; display: inline-block; border-radius: 9999px; background: #f3f3f3; color: #111; }
        .pills .pill.active { background: #111; color: #fff; }
        /* Carril de slides: responsive spacing y tamaños para mostrar hasta 4 items en pantallas grandes */
        .hero-carousel { margin-top: 1rem; }

        .hero-carousel .slides {
            display:flex;
            gap:1rem;
            overflow-x:auto;
            scroll-snap-type:x mandatory;
            -webkit-overflow-scrolling:touch;
            padding: 0 0.75rem;
        }

        /* Mobile (1 por pantalla) */
        @media (max-width: 639px) {
            .hero-carousel { margin-top: 0.6rem; }
            .hero-carousel .slides { padding: 0 0.5rem; }
            .hero-carousel .hero-slide { flex: 0 0 calc(100% - 1rem); }
            .hero-slide .hero-inner { padding: 0.6rem !important; }
        }

        /* Small tablet (2 por pantalla) */
        @media (min-width: 640px) and (max-width: 899px) {
            .hero-carousel { margin-top: 1rem; }
            .hero-carousel .slides { padding: 0 0.75rem; }
            .hero-carousel .hero-slide { flex: 0 0 calc((100% - 1rem) / 2); }
            .hero-slide .hero-inner { padding: 0.85rem !important; }
        }

        /* Medium (3 por pantalla) */
        @media (min-width: 900px) and (max-width: 1199px) {
            .hero-carousel { margin-top: 1.25rem; }
            .hero-carousel .slides { padding: 0 1rem; }
            .hero-carousel .hero-slide { flex: 0 0 calc((100% - 2rem) / 3); }
            .hero-slide .hero-inner { padding: 1rem !important; }
        }

        /* Desktop large (4 por pantalla) */
        @media (min-width: 1200px) {
            .hero-carousel { margin-top: 2rem; }
            .hero-carousel .slides { padding: 0 2rem; }
            /* restamos 3 gaps (1rem each -> 3rem) o 2rem padding depending, approximate with 2rem */
            .hero-carousel .hero-slide { flex: 0 0 calc((100% - 3rem) / 4); }
            .hero-slide .hero-inner { padding: 1.25rem !important; }
        }
    </style>
    
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
                <div class="header-actions" style="position:relative">
                    @auth
                        <a href="{{ route('profile.edit') }}" class="btn-circle" title="Mi perfil">👤</a>
                    @else
                        <a href="{{ url('/login') }}" class="btn-circle" title="Iniciar sesión">👤</a>
                    @endauth

                    <!-- Carrito (ubicado junto al login/perfil) -->
                    <div class="ms-4 relative" style="display:inline-block;">
                        <a href="#" id="cart-toggle" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white dark:text-white dark:bg-gray-800 hover:text-gray-300 focus:outline-none transition ease-in-out duration-150" title="Carrito">🛒<span class="cart-count ml-2">0</span></a>
                        <div id="mini-cart" style="display:none; position:absolute; right:0; top:48px; width:320px; background:#fff; color:#111; border-radius:8px; box-shadow:0 8px 20px rgba(0,0,0,0.2); z-index:50; overflow:hidden;">
                            <div style="padding:12px; border-bottom:1px solid #eee; font-weight:700">Carrito</div>
                            <div id="mini-cart-items" style="max-height:240px; overflow:auto; padding:8px"></div>
                            <div style="padding:12px; border-top:1px solid #eee; display:flex; justify-content:space-between; align-items:center;">
                                <strong>Total:</strong>
                                <span id="mini-cart-total">$0</span>
                            </div>
                            <div style="padding:8px; display:flex; gap:8px; justify-content:space-between;">
                                <a href="{{ route('cart.index') }}" class="btn btn-secondary" style="flex:1">Ver carrito</a>
                                @auth
                                    <form action="{{ route('cart.checkout') }}" method="POST" style="margin:0">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Pagar</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary" style="flex:1">Inicia sesión</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container full search-row">
                <input type="text" placeholder="¿Qué estás buscando hoy?" class="search-input" />
            </div>
            <div class="container full pills-row">
                <div class="pills">
                    <a class="pill active" data-category="all">Todos</a>
                    @if(isset($categorias) && $categorias->isNotEmpty())
                        @foreach($categorias as $cat)
                            <a class="pill" data-category="{{ $cat }}">{{ $cat }}</a>
                        @endforeach
                    @else
                        <a class="pill" data-category="Capas">Capas</a>
                        <a class="pill" data-category="Ceras">Ceras</a>
                        <a class="pill" data-category="Máquinas">Máquinas</a>
                    @endif
                </div>
            </div>
        </header>

    <main class="container full main-content">
            <section class="hero-carousel">
                <button class="carousel-btn prev" aria-label="Anterior" onclick="prevSlide()">‹</button>
                <div class="slides">
                    @if(isset($productos) && $productos->isNotEmpty())
                        @foreach($productos as $producto)
                            @php
                                $stock = isset($producto->stock) ? (int)$producto->stock : null;
                                $hasImage = false;
                                if (!empty($producto->imagen)) {
                                    try {
                                        $hasImage = \Illuminate\Support\Facades\Storage::disk('public')->exists($producto->imagen);
                                    } catch (\Exception $e) {
                                        $hasImage = false;
                                    }
                                }
                            @endphp
                            <article class="hero-slide" data-category="{{ $producto->categoria ?? 'Sin categoría' }}" data-stock="{{ $stock ?? 0 }}" style="position:relative; background-image: linear-gradient(90deg, rgba(0,0,0,0.45), rgba(0,0,0,0.25)), url('{{ ($producto->imagen && $hasImage) ? asset('storage/' . $producto->imagen) : asset('images/slide-1.jpg') }}'); background-size: cover; background-position: center;">
                                <div class="hero-inner p-6 text-white">
                                    <div class="max-w-3xl">
                                        @if(!empty($producto->imagen) && !$hasImage)
                                            <div class="slide-badge" style="position:absolute; left:12px; top:12px; background:rgba(220,38,38,0.9); color:#fff; padding:6px 10px; border-radius:6px; font-weight:700; z-index:60;">Imagen no encontrada</div>
                                        @endif
                                        <h2 class="text-3xl font-bold mb-2">{{ $producto->nombre }}</h2>
                                        <p class="mb-4 text-lg">{{ \Illuminate\Support\Str::limit($producto->descripcion ?? '', 150) }}</p>
                                        <div class="flex items-center gap-4">
                                            <span class="text-2xl font-extrabold">${{ number_format($producto->precio, 0, ',', '.') }}</span>
                                            <form action="{{ route('cart.add', $producto->getKey()) }}" method="POST" class="ajax-add-to-cart">
                                                @csrf
                                                @if($stock === null)
                                                    <input type="hidden" name="qty" value="1">
                                                    <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                                                @else
                                                    @if($stock <= 0)
                                                        <span class="text-red-300 font-semibold">Agotado</span>
                                                        <button type="submit" class="btn btn-primary" disabled>Añadir al carrito</button>
                                                    @else
                                                        <label class="inline-flex items-center">
                                                            <input type="number" name="qty" min="1" max="{{ $stock }}" value="1" class="w-20 px-2 py-1 rounded border bg-white text-black" />
                                                        </label>
                                                        <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                                                        <small class="ml-2">Disponibles: <strong>{{ $stock }}</strong></small>
                                                    @endif
                                                @endif
                                            </form>
                                            <a href="{{ route('productos.show', $producto->getKey()) }}" class="btn btn-secondary">Ver detalle</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <article class="hero-slide" style="background-image: linear-gradient(90deg, rgba(0,0,0,0.35), rgba(0,0,0,0.05)), url('{{ asset('images/slide-1.jpg') }}');">
                            <div class="hero-inner">
                                <h2>Ofertas Babyliss</h2>
                                <p class="hero-price">Ahora: <strong>$700.000</strong></p>
                            </div>
                        </article>
                    @endif
                </div>
                <button class="carousel-btn next" aria-label="Siguiente" onclick="nextSlide()">›</button>
            </section>

    <script>
        // Clamp qty inputs in slides so the user cannot type more than max stock
        document.addEventListener('DOMContentLoaded', function () {
            function clampInput(el) {
                const min = parseInt(el.min || 1);
                const max = parseInt(el.max || 0);
                let val = parseInt(el.value || 1);
                if (isNaN(val) || val < min) val = min;
                if (max > 0 && val > max) {
                    el.value = max;
                    // small feedback
                    const msg = document.createElement('div');
                    msg.textContent = 'Cantidad ajustada al stock disponible (' + max + ')';
                    msg.style.color = '#b91c1c';
                    msg.style.fontSize = '12px';
                    msg.style.marginTop = '6px';
                    el.parentNode.appendChild(msg);
                    setTimeout(() => msg.remove(), 2500);
                    return;
                }
                el.value = val;
            }

            document.querySelectorAll('article.hero-slide input[type="number"][name="qty"]').forEach(input => {
                input.addEventListener('input', function (e) {
                    const max = parseInt(this.max || 0);
                    const min = parseInt(this.min || 1);
                    let v = parseInt(this.value || 0);
                    if (isNaN(v)) v = min;
                    if (max > 0 && v > max) this.value = max;
                    else if (v < min) this.value = min;
                });
                input.addEventListener('change', function (e) { clampInput(this); });
            });
         });
         </script>

            <div class="promo-strip">Domicilio gratis en <strong>Tutunendo, Cabi, Tanando y Tado</strong></div>

            <section class="quick-links">
                <a class="card" href="{{ route('productos.public') }}">Ver catálogo</a>
                <a class="card" href="#">Ofertas</a>
                <a class="card" href="#">Novedades</a>
            </section>
            <!-- Nota: la lista de productos se ha integrado en el slide del carrusel -->
        </main>

        <a class="whatsapp-float" href="https://wa.me/573226569641" target="_blank" rel="noopener">💬</a>

    </x-app-layout>
</body>
</html>