<x-app-layout>
    <div style="background:#F4F6F9; min-height:calc(100vh - 64px); font-family:'Outfit',sans-serif; padding-top: 32px;">

        <div style="max-width:1400px; margin:0 auto; padding:32px 24px;">
            <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(280px,1fr)); gap:24px;">
                @forelse($productos as $producto)
                    <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07); display:flex; flex-direction:column; transition:transform .2s, box-shadow .2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.07)'">
                        
                        {{-- Image --}}
                        <div style="height:180px; background:linear-gradient(135deg,#111827,#1a2332); display:flex; align-items:center; justify-content:center; position:relative;">
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <i class="fas fa-box" style="font-size:3.5rem; color:rgba(255,255,255,0.2);"></i>
                            @endif
                            
                            {{-- Stock Badge --}}
                            <div style="position:absolute; top:12px; right:12px;">
                                @if(($producto->stock ?? 0) <= 0)
                                    <span style="background:#C62828; color:#fff; padding:4px 10px; border-radius:999px; font-size:0.75rem; font-weight:700;">Agotado</span>
                                @elseif($producto->stock <= 5)
                                    <span style="background:#F57F17; color:#fff; padding:4px 10px; border-radius:999px; font-size:0.75rem; font-weight:700;">¡Solo {{ $producto->stock }}!</span>
                                @else
                                    <span style="background:#2E7D32; color:#fff; padding:4px 10px; border-radius:999px; font-size:0.75rem; font-weight:700;">Disponible</span>
                                @endif
                            </div>
                        </div>

                        {{-- Info --}}
                        <div style="padding:20px; flex:1; display:flex; flex-direction:column; gap:8px;">
                            <h3 style="margin:0; font-size:1.1rem; font-weight:800; color:#111827;">{{ $producto->nombre }}</h3>
                            <p style="margin:0; font-size:0.88rem; color:#6B7280; line-height:1.5;">{{ Str::limit($producto->descripcion ?? '', 90) }}</p>
                            @if($producto->categoria ?? false)
                                <span style="background:rgba(21,101,192,0.1); color:#1565C0; padding:3px 10px; border-radius:999px; font-size:0.75rem; font-weight:700; display:inline-block; width:fit-content; margin-top:4px;">{{ $producto->categoria }}</span>
                            @endif
                            <div style="font-size:1.4rem; font-weight:800; color:#1565C0; margin-top:auto; padding-top:12px;">${{ number_format($producto->precio, 0, ',', '.') }}</div>
                        </div>

                        {{-- Actions --}}
                        <div style="padding:16px 20px; border-top:1px solid #F4F6F9; display:flex; gap:10px;">
                            <a href="{{ route('productos.show', $producto->_id ?? $producto->id) }}" style="flex:1; display:flex; align-items:center; justify-content:center; gap:6px; padding:10px; background:#F4F6F9; color:#374151; border-radius:10px; border:1px solid #E8ECF0; text-decoration:none; font-size:0.88rem; font-weight:700; transition:background .2s;" onmouseover="this.style.background='#E8ECF0'" onmouseout="this.style.background='#F4F6F9'">
                                <i class="fas fa-eye"></i> Detalles
                            </a>
                            <form action="{{ route('cart.add', $producto->_id ?? $producto->id) }}" method="POST" class="ajax-add-to-cart" style="flex:1; margin:0;">
                                @csrf
                                <input type="hidden" name="qty" value="1">
                                <button type="submit" style="width:100%; display:flex; align-items:center; justify-content:center; gap:6px; padding:10px; background:#111827; color:#fff; border-radius:10px; border:none; font-size:0.88rem; font-weight:700; font-family:'Outfit',sans-serif; cursor:{{ ($producto->stock !== null && $producto->stock <= 0) ? 'not-allowed' : 'pointer' }}; opacity:{{ ($producto->stock !== null && $producto->stock <= 0) ? '0.6' : '1' }}; transition:background .2s;" {{ ($producto->stock !== null && $producto->stock <= 0) ? 'disabled' : '' }} onmouseover="if(!this.disabled) this.style.background='#1a2332'" onmouseout="if(!this.disabled) this.style.background='#111827'">
                                    <i class="fas fa-cart-plus"></i> Añadir
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div style="grid-column:1/-1; text-align:center; padding:72px 24px; background:#fff; border-radius:16px; box-shadow:0 4px 20px rgba(0,0,0,0.07);">
                        <i class="fas fa-box-open" style="font-size:3rem; color:#E8ECF0; display:block; margin-bottom:16px;"></i>
                        <h3 style="margin:0 0 8px; color:#111827;">No hay productos</h3>
                        <p style="color:#6B7280; margin:0;">Actualmente no disponemos de productos en la tienda.</p>
                    </div>
                @endforelse
            </div>

            <div style="margin-top:32px; display:flex; justify-content:center;">
                {{ $productos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>