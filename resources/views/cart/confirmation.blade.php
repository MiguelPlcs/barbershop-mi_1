<x-app-layout>
<div style="background:#F4F6F9; min-height:calc(100vh - 64px); font-family:'Outfit',sans-serif;">

    <div style="background:#fff; border-bottom:3px solid #2E7D32; padding:20px 32px;">
        <h1 style="margin:0; font-size:1.4rem; font-weight:800; color:#111827; display:flex; align-items:center; gap:10px;">
            <i class="fas fa-circle-check" style="color:#2E7D32;"></i> Pago confirmado
        </h1>
        {{-- Steps --}}
        <div style="display:flex; align-items:center; gap:0; margin-top:14px;">
            <div style="display:flex; align-items:center; gap:8px;">
                <div style="width:28px; height:28px; border-radius:50%; background:#E8ECF0; color:#6B7280; display:flex; align-items:center; justify-content:center; font-size:0.8rem; font-weight:700;">✓</div>
                <span style="font-size:0.85rem; color:#6B7280;">Carrito</span>
            </div>
            <div style="width:40px; height:2px; background:#E8ECF0; margin:0 8px;"></div>
            <div style="display:flex; align-items:center; gap:8px;">
                <div style="width:28px; height:28px; border-radius:50%; background:#E8ECF0; color:#6B7280; display:flex; align-items:center; justify-content:center; font-size:0.8rem; font-weight:700;">✓</div>
                <span style="font-size:0.85rem; color:#6B7280;">Pago</span>
            </div>
            <div style="width:40px; height:2px; background:#2E7D32; margin:0 8px;"></div>
            <div style="display:flex; align-items:center; gap:8px;">
                <div style="width:28px; height:28px; border-radius:50%; background:#2E7D32; color:#fff; display:flex; align-items:center; justify-content:center; font-size:0.8rem; font-weight:700;">✓</div>
                <span style="font-size:0.85rem; color:#2E7D32; font-weight:700;">Confirmación</span>
            </div>
        </div>
    </div>

    <div style="max-width:720px; margin:0 auto; padding:28px 24px;">

        {{-- Success Banner --}}
        <div style="background:linear-gradient(135deg,#1565C0,#0D47A1); border-radius:16px; padding:32px; text-align:center; margin-bottom:24px; box-shadow:0 8px 32px rgba(21,101,192,0.3); position:relative; overflow:hidden;">
            <div style="position:absolute; top:-20px; right:-20px; width:120px; height:120px; border-radius:50%; background:rgba(255,255,255,0.05);"></div>
            <div style="position:absolute; bottom:-30px; left:-30px; width:100px; height:100px; border-radius:50%; background:rgba(255,255,255,0.04);"></div>
            <div style="width:72px; height:72px; border-radius:50%; background:rgba(255,255,255,0.15); display:flex; align-items:center; justify-content:center; margin:0 auto 16px; position:relative; z-index:1;">
                <i class="fas fa-circle-check" style="font-size:2.2rem; color:#fff;"></i>
            </div>
            <h2 style="margin:0 0 8px; color:#fff; font-size:1.5rem; font-weight:800; position:relative; z-index:1;">¡Pago recibido con éxito!</h2>
            <p style="margin:0 0 16px; color:rgba(255,255,255,0.8); font-size:0.95rem; position:relative; z-index:1;">Tu pago ha sido procesado, el pedido está a la espera de confirmación.</p>
            <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.2); border-radius:999px; padding:8px 20px; position:relative; z-index:1;">
                <i class="fas fa-hashtag" style="font-size:0.85rem; color:rgba(255,255,255,0.8);"></i>
                <span style="color:#fff; font-weight:700; font-size:0.95rem;">Orden: {{ $order->order_number }}</span>
            </div>
        </div>

        {{-- Estado del Envío Tracker --}}
        <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07); margin-bottom:20px;">
            <div style="background:#111827; padding:16px 24px; display:flex; align-items:center; justify-content:space-between;">
                <span style="color:#fff; font-weight:700; font-size:1rem; display:flex; align-items:center; gap:10px;">
                    <i class="fas fa-truck-fast" style="color:#1976D2;"></i> Estado del Envío
                </span>
                @php
                    $status = strtolower($order->status ?? 'pendiente');
                    $bg = 'rgba(21,101,192,0.1)'; $col = '#1565C0';
                    if($status == 'confirmado') { $bg = 'rgba(245,127,23,0.1)'; $col = '#F57F17'; }
                    if($status == 'enviado') { $bg = 'rgba(2,136,209,0.1)'; $col = '#0288D1'; }
                    if($status == 'punto de entrega fisico') { $bg = 'rgba(46,125,50,0.1)'; $col = '#2E7D32'; }
                    if($status == 'cancelado') { $bg = 'rgba(198,40,40,0.1)'; $col = '#C62828'; }
                @endphp
                <span style="background:{{ $bg }}; color:{{ $col }}; padding:6px 14px; border-radius:999px; font-size:0.8rem; font-weight:800; text-transform:uppercase; letter-spacing:0.04em;">
                    {{ $order->status ?? 'Pendiente' }}
                </span>
            </div>
            
            <div style="padding:32px 24px;">
                @if($status == 'cancelado')
                    <div style="text-align:center; color:#C62828;">
                        <i class="fas fa-ban" style="font-size:3rem; margin-bottom:16px;"></i>
                        <h3 style="margin:0 0 8px;">Pedido Cancelado</h3>
                        <p style="margin:0; color:#6B7280;">Este pedido ha sido cancelado. Si tienes dudas, contáctanos.</p>
                    </div>
                @else
                    @php
                        $step = 1; // Pendiente
                        if($status == 'confirmado') $step = 2;
                        if($status == 'enviado') $step = 3;
                        if($status == 'punto de entrega fisico') $step = 4;
                    @endphp
                    
                    <div style="display:flex; justify-content:space-between; position:relative; max-width:500px; margin:0 auto;">
                        {{-- Linea de progreso de fondo --}}
                        <div style="position:absolute; top:20px; left:10%; right:10%; height:4px; background:#E8ECF0; z-index:0; border-radius:2px;"></div>
                        {{-- Linea de progreso activa --}}
                        <div style="position:absolute; top:20px; left:10%; width:{{ ($step-1)*30 }}%; height:4px; background:#1565C0; z-index:0; border-radius:2px; transition:width 0.5s ease;"></div>

                        {{-- Step 1: Pendiente --}}
                        <div style="display:flex; flex-direction:column; align-items:center; position:relative; z-index:1; width:80px;">
                            <div style="width:44px; height:44px; border-radius:50%; background:{{ $step >= 1 ? '#1565C0' : '#fff' }}; border:4px solid {{ $step >= 1 ? '#1565C0' : '#E8ECF0' }}; color:{{ $step >= 1 ? '#fff' : '#9AA7B6' }}; display:flex; align-items:center; justify-content:center; font-size:1.1rem; font-weight:700; margin-bottom:10px; transition:all 0.3s;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <span style="font-size:0.75rem; font-weight:{{ $step >= 1 ? '800' : '600' }}; color:{{ $step >= 1 ? '#111827' : '#9AA7B6' }}; text-align:center;">Pendiente</span>
                        </div>

                        {{-- Step 2: Confirmado --}}
                        <div style="display:flex; flex-direction:column; align-items:center; position:relative; z-index:1; width:80px;">
                            <div style="width:44px; height:44px; border-radius:50%; background:{{ $step >= 2 ? '#1565C0' : '#fff' }}; border:4px solid {{ $step >= 2 ? '#1565C0' : '#E8ECF0' }}; color:{{ $step >= 2 ? '#fff' : '#9AA7B6' }}; display:flex; align-items:center; justify-content:center; font-size:1.1rem; font-weight:700; margin-bottom:10px; transition:all 0.3s;">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <span style="font-size:0.75rem; font-weight:{{ $step >= 2 ? '800' : '600' }}; color:{{ $step >= 2 ? '#111827' : '#9AA7B6' }}; text-align:center;">Confirmado</span>
                        </div>

                        {{-- Step 3: Enviado --}}
                        <div style="display:flex; flex-direction:column; align-items:center; position:relative; z-index:1; width:80px;">
                            <div style="width:44px; height:44px; border-radius:50%; background:{{ $step >= 3 ? '#1565C0' : '#fff' }}; border:4px solid {{ $step >= 3 ? '#1565C0' : '#E8ECF0' }}; color:{{ $step >= 3 ? '#fff' : '#9AA7B6' }}; display:flex; align-items:center; justify-content:center; font-size:1.1rem; font-weight:700; margin-bottom:10px; transition:all 0.3s;">
                                <i class="fas fa-truck"></i>
                            </div>
                            <span style="font-size:0.75rem; font-weight:{{ $step >= 3 ? '800' : '600' }}; color:{{ $step >= 3 ? '#111827' : '#9AA7B6' }}; text-align:center;">Enviado</span>
                        </div>

                        {{-- Step 4: Entregado --}}
                        <div style="display:flex; flex-direction:column; align-items:center; position:relative; z-index:1; width:80px;">
                            <div style="width:44px; height:44px; border-radius:50%; background:{{ $step >= 4 ? '#2E7D32' : '#fff' }}; border:4px solid {{ $step >= 4 ? '#2E7D32' : '#E8ECF0' }}; color:{{ $step >= 4 ? '#fff' : '#9AA7B6' }}; display:flex; align-items:center; justify-content:center; font-size:1.1rem; font-weight:700; margin-bottom:10px; transition:all 0.3s;">
                                <i class="fas fa-home"></i>
                            </div>
                            <span style="font-size:0.75rem; font-weight:{{ $step >= 4 ? '800' : '600' }}; color:{{ $step >= 4 ? '#111827' : '#9AA7B6' }}; text-align:center; line-height:1.2;">Punto de entrega</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Order Details --}}
        <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07); margin-bottom:20px;">
            <div style="background:#111827; padding:16px 24px; display:flex; align-items:center; gap:10px;">
                <i class="fas fa-receipt" style="color:#1976D2;"></i>
                <span style="color:#fff; font-weight:700; font-size:1rem;">Detalle de la orden</span>
            </div>

            @if(!empty($order->payer_name) || !empty($order->payment_method))
            <div style="padding:16px 24px; border-bottom:1px solid #F4F6F9; display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                <div style="background:#F4F6F9; border-radius:10px; padding:14px 16px;">
                    <div style="font-size:0.78rem; font-weight:700; color:#9AA7B6; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Pagado por</div>
                    <div style="font-weight:700; color:#111827;">{{ $order->payer_name ?? 'N/A' }}</div>
                </div>
                <div style="background:#F4F6F9; border-radius:10px; padding:14px 16px;">
                    <div style="font-size:0.78rem; font-weight:700; color:#9AA7B6; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Método de pago</div>
                    <div style="font-weight:700; color:#111827;">{{ ucfirst($order->payment_method ?? 'N/A') }}</div>
                </div>
            </div>
            @endif

            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse; font-size:0.93rem;">
                    <thead>
                        <tr style="background:#F4F6F9; border-bottom:2px solid #E8ECF0;">
                            <th style="padding:12px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Producto</th>
                            <th style="padding:12px 20px; text-align:right; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Precio</th>
                            <th style="padding:12px 20px; text-align:center; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Cant.</th>
                            <th style="padding:12px 20px; text-align:right; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr style="border-bottom:1px solid #F4F6F9;">
                            <td style="padding:14px 20px; font-weight:600; color:#111827;">{{ $item['nombre'] }}</td>
                            <td style="padding:14px 20px; text-align:right; color:#6B7280;">${{ number_format($item['precio'], 0, ',', '.') }}</td>
                            <td style="padding:14px 20px; text-align:center;">
                                <span style="background:#F4F6F9; padding:4px 12px; border-radius:8px; font-weight:600; color:#374151;">{{ $item['qty'] }}</span>
                            </td>
                            <td style="padding:14px 20px; text-align:right; font-weight:700; color:#1565C0;">${{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="background:#F4F6F9;">
                            <td colspan="3" style="padding:14px 20px; font-weight:800; color:#111827;">Total pagado</td>
                            <td style="padding:14px 20px; text-align:right; font-weight:800; color:#1565C0; font-size:1.1rem;">${{ number_format($order->total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- Actions --}}
        <div style="display:flex; gap:12px; justify-content:flex-end;">
            <a href="{{ route('productos.user') }}" style="display:inline-flex; align-items:center; gap:8px; padding:12px 22px; background:#F4F6F9; color:#374151; border-radius:12px; text-decoration:none; font-weight:600; border:2px solid #E8ECF0; transition:all .2s;" onmouseover="this.style.background='#E8ECF0'" onmouseout="this.style.background='#F4F6F9'">
                <i class="fas fa-store"></i> Seguir comprando
            </a>
            <button onclick="window.print();" style="display:inline-flex; align-items:center; gap:8px; padding:12px 22px; background:#1565C0; color:#fff; border-radius:12px; border:none; font-family:'Outfit',sans-serif; font-size:0.95rem; font-weight:700; cursor:pointer; box-shadow:0 4px 16px rgba(21,101,192,0.3); transition:all .2s;" onmouseover="this.style.background='#1976D2'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#1565C0'; this.style.transform='translateY(0)'">
                <i class="fas fa-print"></i> Imprimir comprobante
            </button>
        </div>
    </div>
</div>
</x-app-layout>
