{{-- filepath: resources/views/productos/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle del producto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <style>
                        .prod-show { display:flex; flex-direction:column; gap:18px; }
                        .prod-hero { display:flex; gap:24px; align-items:flex-start; flex-direction:column; }
                        .prod-media { width:100%; max-width:420px; margin:0 auto; background:#0f1724; padding:12px; border-radius:12px; display:flex; align-items:center; justify-content:center; }
                        .prod-media img{ width:100%; height:auto; max-height:420px; object-fit:contain; display:block; }
                        .prod-info { padding:8px 4px; text-align:center; }
                        .prod-title{ font-size:1.6rem; color:#ffd54f; font-weight:800; margin:0 0 8px 0 }
                        .prod-price{ font-size:1.25rem; color:#fff; font-weight:900; margin-bottom:8px }
                        .prod-desc{ color:#cbd5e1; line-height:1.5; margin-bottom:12px; }
                        .prod-meta { display:flex; gap:12px; justify-content:center; align-items:center; margin-bottom:12px }
                        .btn-back { display:inline-block; padding:10px 14px; border-radius:8px; background:transparent; color:#cbd5e1; border:2px solid rgba(255,255,255,0.04); text-decoration:none }
                    </style>

                    <div class="prod-show">
                        <div class="prod-hero">
                            <div class="prod-media">
                                @if(!empty($producto->imagen) && \Illuminate\Support\Facades\Storage::disk('public')->exists($producto->imagen))
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                                    @else
                                        <img src="{{ asset('images/no-image.svg') }}" alt="Sin imagen">
                                @endif
                            </div>

                            <div class="prod-info">
                                <h1 class="prod-title">{{ $producto->nombre }}</h1>
                                <div class="prod-price">${{ number_format($producto->precio,0,',','.') }}</div>
                                <div class="prod-meta">
                                    @if(isset($producto->stock))
                                        <div class="stock {{ $producto->stock > 0 ? 'in-stock' : 'out-stock' }}">{{ $producto->stock > 0 ? "Stock: {$producto->stock}" : 'Agotado' }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 style="color:#ffd54f; margin-bottom:8px">Descripción</h3>
                            <p class="prod-desc">{{ $producto->descripcion ?? 'No hay descripción disponible.' }}</p>
                        </div>

                        <div style="text-align:center">
                            <a href="{{ route('productos.public') }}" class="btn-back">Volver al catálogo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
