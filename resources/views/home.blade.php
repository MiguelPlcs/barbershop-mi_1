<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Barbershop</title>
    <!-- Favicon (logo en la pestaña) -->
    <link rel="icon" href="{{ asset('images/logo.png') }}?v=2" type="image/png">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}?v=2" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}?v=2">
    @vite(['resources/css/app.css', 'resources/css/home.css', 'resources/js/app.js'])
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
        /* Carril de slides: responsive spacing y tamaños fijos para evitar que se colapsen */
        .hero-carousel { margin-top: 1rem; position: relative; }

        .hero-carousel .slides {
            display:flex;
            gap:24px;
            overflow-x:auto;
            scroll-snap-type:x mandatory;
            -webkit-overflow-scrolling:touch;
            padding: 24px;
            scroll-behavior: smooth;
        }

        .hero-carousel .hero-slide {
            flex: 0 0 280px;
            scroll-snap-align: start;
        }

        /* Mobile (1 por pantalla) */
        @media (max-width: 639px) {
            .hero-carousel .hero-slide { flex: 0 0 85%; }
        }
    </style>
    
</head>
<body>
    {{-- filepath: resources/views/home.blade.php --}}
    <x-app-layout>
        <x-slot name="hideNav">true</x-slot>
        
        <header style="background: #0a0a0a; border-bottom: 1px solid rgba(255,255,255,0.08); padding: 0 0 16px 0; position: sticky; top: 0; z-index: 100;">
            {{-- Top Navbar --}}
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 16px 32px; max-width: 1400px; margin: 0 auto;">
                
                {{-- Logo --}}
                <a href="{{ url('/') }}" style="display: flex; align-items: center; gap: 12px; text-decoration: none;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 48px; filter: drop-shadow(0 4px 12px rgba(198,40,40,0.3));">
                    <span style="color: #fff; font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.4rem; letter-spacing: 0.05em;">Barbershop</span>
                </a>

                {{-- Main Links --}}
                <nav style="display: flex; gap: 28px; align-items: center;">
                    <a href="#" style="color: #fff; text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: color 0.2s;" onmouseover="this.style.color='#1976D2'" onmouseout="this.style.color='#fff'">Inicio</a>
                    <a href="{{ route('productos.public') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: color 0.2s;" onmouseover="this.style.color='#1976D2'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">Tienda</a>
                    <a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: color 0.2s;" onmouseover="this.style.color='#1976D2'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">Nosotros</a>
                    <a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: color 0.2s;" onmouseover="this.style.color='#1976D2'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">Contacto</a>
                </nav>

                {{-- Actions --}}
                <div style="display: flex; gap: 16px; align-items: center;">
                    @auth
                        <a href="{{ route('profile.edit') }}" style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(255,255,255,0.1); color: #fff; border-radius: 50%; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                            <i class="fas fa-user"></i>
                        </a>
                    @else
                        <a href="{{ url('/login') }}" style="display: flex; align-items: center; gap: 8px; background: #1565C0; color: #fff; padding: 10px 20px; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 0.95rem; transition: all 0.2s; box-shadow: 0 4px 16px rgba(21,101,192,0.3);" onmouseover="this.style.background='#1976D2'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#1565C0'; this.style.transform='translateY(0)'">
                            <i class="fas fa-right-to-bracket"></i> Iniciar sesión
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Search & Pills Row --}}
            <div style="max-width: 1400px; margin: 0 auto; padding: 0 32px; display: flex; flex-direction: column; gap: 16px;">
                
                {{-- Search --}}
                <div style="position: relative; max-width: 600px; width: 100%; margin: 0 auto;">
                    <i class="fas fa-magnifying-glass" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.4);"></i>
                    <input type="text" placeholder="¿Qué estás buscando hoy?" style="width: 100%; padding: 12px 16px 12px 44px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 999px; color: #fff; font-family: 'Outfit', sans-serif; font-size: 0.95rem; outline: none; transition: all 0.2s;" onfocus="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.2)'" onblur="this.style.background='rgba(255,255,255,0.06)'; this.style.borderColor='rgba(255,255,255,0.1)'">
                </div>

                {{-- Category Pills --}}
                <div class="pills" style="display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; margin-top: 8px;">
                    <a href="#" class="pill active" data-category="all" style="padding: 8px 18px; background: #C62828; color: #fff; border-radius: 999px; text-decoration: none; font-size: 0.88rem; font-weight: 700; transition: background 0.2s; box-shadow: 0 4px 12px rgba(198,40,40,0.3);">Todos</a>
                    @if(isset($categorias) && $categorias->isNotEmpty())
                        @foreach($categorias as $cat)
                            <a href="#" class="pill" data-category="{{ $cat }}" style="padding: 8px 18px; background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.8); border-radius: 999px; text-decoration: none; font-size: 0.88rem; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.color='#fff'" onmouseout="if(!this.classList.contains('active')) { this.style.background='rgba(255,255,255,0.08)'; this.style.color='rgba(255,255,255,0.8)'; }">{{ $cat }}</a>
                        @endforeach
                    @else
                        <a href="#" class="pill" data-category="Ceras" style="padding: 8px 18px; background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.8); border-radius: 999px; text-decoration: none; font-size: 0.88rem; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.color='#fff'" onmouseout="if(!this.classList.contains('active')) { this.style.background='rgba(255,255,255,0.08)'; this.style.color='rgba(255,255,255,0.8)'; }">Ceras</a>
                        <a href="#" class="pill" data-category="Trimmer" style="padding: 8px 18px; background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.8); border-radius: 999px; text-decoration: none; font-size: 0.88rem; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.color='#fff'" onmouseout="if(!this.classList.contains('active')) { this.style.background='rgba(255,255,255,0.08)'; this.style.color='rgba(255,255,255,0.8)'; }">Trimmer</a>
                        <a href="#" class="pill" data-category="Tijeras" style="padding: 8px 18px; background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.8); border-radius: 999px; text-decoration: none; font-size: 0.88rem; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.color='#fff'" onmouseout="if(!this.classList.contains('active')) { this.style.background='rgba(255,255,255,0.08)'; this.style.color='rgba(255,255,255,0.8)'; }">Tijeras</a>
                        <a href="#" class="pill" data-category="Envace" style="padding: 8px 18px; background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.8); border-radius: 999px; text-decoration: none; font-size: 0.88rem; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.color='#fff'" onmouseout="if(!this.classList.contains('active')) { this.style.background='rgba(255,255,255,0.08)'; this.style.color='rgba(255,255,255,0.8)'; }">Envace</a>
                        <a href="#" class="pill" data-category="Maquinas" style="padding: 8px 18px; background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.8); border-radius: 999px; text-decoration: none; font-size: 0.88rem; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.color='#fff'" onmouseout="if(!this.classList.contains('active')) { this.style.background='rgba(255,255,255,0.08)'; this.style.color='rgba(255,255,255,0.8)'; }">Maquinas</a>
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
                            <article class="hero-slide" data-category="{{ $producto->categoria ?? 'Sin categoría' }}" data-stock="{{ $stock ?? 0 }}" style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07); display:flex; flex-direction:column; transition:transform .2s, box-shadow .2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.07)'">
                                
                                {{-- Image --}}
                                <div style="height:200px; background:linear-gradient(135deg,#111827,#1a2332); display:flex; align-items:center; justify-content:center; position:relative;">
                                    @if($hasImage)
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" style="width:100%; height:100%; object-fit:cover;">
                                    @else
                                        <i class="fas fa-box" style="font-size:3.5rem; color:rgba(255,255,255,0.2);"></i>
                                    @endif
                                    
                                    {{-- Stock Badge --}}
                                    <div style="position:absolute; top:12px; right:12px;">
                                        @if($stock !== null)
                                            @if($stock <= 0)
                                                <span style="background:#C62828; color:#fff; padding:4px 10px; border-radius:999px; font-size:0.75rem; font-weight:700;">Agotado</span>
                                            @elseif($stock <= 5)
                                                <span style="background:#F57F17; color:#fff; padding:4px 10px; border-radius:999px; font-size:0.75rem; font-weight:700;">¡Solo {{ $stock }}!</span>
                                            @else
                                                <span style="background:#2E7D32; color:#fff; padding:4px 10px; border-radius:999px; font-size:0.75rem; font-weight:700;">Disponible</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                                {{-- Info --}}
                                <div style="padding:20px; flex:1; display:flex; flex-direction:column; gap:8px;">
                                    <h3 style="margin:0; font-size:1.1rem; font-weight:800; color:#111827;">{{ $producto->nombre }}</h3>
                                    <p style="margin:0; font-size:0.88rem; color:#6B7280; line-height:1.5;">{{ \Illuminate\Support\Str::limit($producto->descripcion ?? '', 90) }}</p>
                                    @if($producto->categoria ?? false)
                                        <span style="background:rgba(21,101,192,0.1); color:#1565C0; padding:3px 10px; border-radius:999px; font-size:0.75rem; font-weight:700; display:inline-block; width:fit-content; margin-top:4px;">{{ $producto->categoria }}</span>
                                    @endif
                                    <div style="font-size:1.4rem; font-weight:800; color:#1565C0; margin-top:auto; padding-top:12px;">${{ number_format($producto->precio, 0, ',', '.') }}</div>
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

    <!-- Removed inline qty-clamp script because quantity selector removed from carousel -->

            <div class="promo-strip">Domicilio gratis en <strong>barrios centrales</strong></div>

            <!-- quick-links removed per request -->
            <!-- Nota: la lista de productos se ha integrado en el slide del carrusel -->
        </main>

        <a class="whatsapp-float" href="https://wa.me/573226569641" target="_blank" rel="noopener">💬</a>

    </x-app-layout>
</body>
</html>