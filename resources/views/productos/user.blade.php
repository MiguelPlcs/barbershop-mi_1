{{-- filepath: resources/views/productos/user.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Catálogo de Productos (Usuario registrado)
        </h2>
    </x-slot>

    <div class="py-12">
        <style>
            /* Inline styles to ensure immediate effect for this view */
            .user-products-grid{display:grid;grid-template-columns:1fr;gap:18px}
            .product-card{background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(255,255,255,0.01));border:1px solid rgba(255,255,255,0.03);border-radius:12px;overflow:hidden;box-shadow:0 8px 20px rgba(2,6,23,0.28);transition:transform .18s ease,box-shadow .18s}
            .product-card:hover{transform:translateY(-8px);box-shadow:0 18px 40px rgba(2,6,23,0.45)}
            .product-media{position:relative;display:flex;align-items:center;justify-content:center;overflow:hidden;aspect-ratio:4/3;min-height:150px;background:#0f1724}
            .product-media img{width:100%;height:100%;object-fit:cover;display:block}
            .price-badge{position:absolute;top:10px;right:10px;background:linear-gradient(180deg,#ffd54f,#f0b429);color:#08121a;padding:6px 10px;border-radius:999px;font-weight:800;box-shadow:0 6px 18px rgba(2,6,23,0.18)}
            .product-body{padding:14px 16px;color:#cbd5e1}
            .product-title{font-size:1.1rem;margin:0 0 6px;color:#ffd54f;font-weight:800}
            .product-desc{margin:0 0 10px;font-size:.95rem;color:#cbd5e1}
            .product-meta{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:6px}
            .product-meta .stock{padding:6px 10px;border-radius:999px;font-weight:700;font-size:.85rem}
            .in-stock{background:#052e12;color:#9ae6b4}
            .out-stock{background:#2b0b0b;color:#ffb4a2}
            .product-actions{display:flex;gap:10px;padding:12px 16px 16px 16px;justify-content:flex-end}
            .btn-buy{background:linear-gradient(180deg,#16a34a,#12803a);color:#fff;border:none;padding:10px 14px;border-radius:8px;font-weight:700;cursor:pointer}
            .btn-view{background:transparent;color:#ffd54f;border:2px solid rgba(255,213,79,0.12);padding:8px 12px;border-radius:8px;font-weight:700}
            @media(min-width:700px){.user-products-grid{grid-template-columns:repeat(2,1fr)}}
            @media(min-width:1100px){.user-products-grid{grid-template-columns:repeat(3,1fr)}}
        </style>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="alert alert-success mb-4">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
                    @endif

                    <div class="user-products-grid">
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
                            <article class="product-card">
                                <div class="product-media">
                                    @if($hasImage)
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                                    @else
                                        <img src="{{ asset('images/no-image.svg') }}" alt="Sin imagen">
                                    @endif
                                    <div class="price-badge">${{ number_format($producto->precio,0,',','.') }}</div>
                                </div>
                                <div class="product-body">
                                    <h3 class="product-title">{{ $producto->nombre }}</h3>
                                    <p class="product-desc">{{ \Illuminate\Support\Str::limit($producto->descripcion ?? '', 120) }}</p>
                                    <div class="product-meta">
                                        <div class="price">${{ number_format($producto->precio,0,',','.') }}</div>
                                        @if($stock !== null)
                                            <div class="stock {{ $stock > 0 ? 'in-stock' : 'out-stock' }}">{{ $stock > 0 ? "Stock: {$stock}" : 'Agotado' }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-actions">
                                    <form action="{{ route('cart.add', $producto->getKey()) }}" method="POST" class="ajax-add-to-cart" style="margin:0">
                                        @csrf
                                        <input type="hidden" name="qty" value="1">
                                        <button type="submit" class="btn-buy" {{ ($stock !== null && $stock <= 0) ? 'disabled' : '' }}>Comprar</button>
                                    </form>
                                    <a href="{{ route('productos.show', $producto->getKey()) }}" class="btn-view">Ver</a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div class="mt-6">{{ $productos->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>