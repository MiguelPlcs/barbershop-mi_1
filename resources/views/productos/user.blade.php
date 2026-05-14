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

            {{-- Sección Mis Pedidos --}}
            <div style="margin-top:48px; background:#fff; border-radius:16px; box-shadow:0 4px 20px rgba(0,0,0,0.07); overflow:hidden;">
                <div style="background:#111827; padding:16px 24px; display:flex; align-items:center; justify-content:space-between;">
                    <span style="color:#fff; font-weight:700; font-size:1.1rem; display:flex; align-items:center; gap:10px;">
                        <i class="fas fa-box-open" style="color:#1976D2;"></i> Mis Pedidos
                    </span>
                    <span style="background:rgba(255,255,255,0.1); color:rgba(255,255,255,0.7); padding:4px 12px; border-radius:999px; font-size:0.82rem;">
                        {{ $orders->count() }} pedidos
                    </span>
                </div>
                
                @if($orders->count() > 0)
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; font-size:0.93rem;">
                        <thead>
                            <tr style="background:#F4F6F9; border-bottom:2px solid #E8ECF0;">
                                <th style="padding:13px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">N° Orden</th>
                                <th style="padding:13px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Fecha</th>
                                <th style="padding:13px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Método Pago</th>
                                <th style="padding:13px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Total</th>
                                <th style="padding:13px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Estado</th>
                                <th style="padding:13px 20px; text-align:right; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $o)
                            <tr style="border-bottom:1px solid #F4F6F9; transition:background .15s;" onmouseover="this.style.background='#F9FAFB'" onmouseout="this.style.background='transparent'">
                                <td style="padding:14px 20px; font-weight:700; color:#111827;">{{ $o->order_number }}</td>
                                <td style="padding:14px 20px; color:#6B7280;">{{ $o->created_at->format('d/m/Y H:i') }}</td>
                                <td style="padding:14px 20px; color:#6B7280; text-transform:capitalize;">{{ $o->payment_method ?? 'N/A' }}</td>
                                <td style="padding:14px 20px; font-weight:800; color:#1565C0;">${{ number_format($o->total, 0, ',', '.') }}</td>
                                <td style="padding:14px 20px;">
                                    @php
                                        $status = strtolower($o->status ?? 'pendiente');
                                        $bg = 'rgba(21,101,192,0.1)'; $col = '#1565C0'; // Pendiente/Por defecto
                                        if($status == 'confirmado') { $bg = 'rgba(245,127,23,0.1)'; $col = '#F57F17'; }
                                        if($status == 'enviado') { $bg = 'rgba(2,136,209,0.1)'; $col = '#0288D1'; }
                                        if($status == 'punto de entrega fisico') { $bg = 'rgba(46,125,50,0.1)'; $col = '#2E7D32'; }
                                        if($status == 'cancelado') { $bg = 'rgba(198,40,40,0.1)'; $col = '#C62828'; }
                                    @endphp
                                    <span style="background:{{ $bg }}; color:{{ $col }}; padding:4px 12px; border-radius:999px; font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.04em;">
                                        {{ $o->status ?? 'Pendiente' }}
                                    </span>
                                </td>
                                <td style="padding:14px 20px; text-align:right;">
                                    <a href="{{ route('cart.confirmation', $o->id) }}" style="background:rgba(21,101,192,0.1); color:#1565C0; border:none; padding:6px 12px; border-radius:8px; text-decoration:none; display:inline-flex; align-items:center; gap:6px; font-weight:600; font-size:0.8rem; transition:all .2s;" onmouseover="this.style.background='#1565C0'; this.style.color='#fff'" onmouseout="this.style.background='rgba(21,101,192,0.1)'; this.style.color='#1565C0'">
                                        <i class="fas fa-file-invoice"></i> Ver
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div style="text-align:center; padding:48px 24px; color:#9AA7B6;">
                    <i class="fas fa-box" style="font-size:2.5rem; display:block; margin-bottom:14px;"></i>
                    <p style="margin:0;">Aún no has realizado ningún pedido.</p>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>