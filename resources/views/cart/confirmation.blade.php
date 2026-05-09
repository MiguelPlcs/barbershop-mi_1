<x-app-layout>
<div style="background:#F4F6F9; min-height:calc(100vh - 64px); font-family:'Outfit',sans-serif;">

    <div style="background:#fff; border-bottom:3px solid #2E7D32; padding:20px 32px;">
        <h1 style="margin:0; font-size:1.4rem; font-weight:800; color:#111827; display:flex; align-items:center; gap:10px;">
            <i class="fas fa-circle-check" style="color:#2E7D32;"></i> Compra confirmada
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
            <h2 style="margin:0 0 8px; color:#fff; font-size:1.5rem; font-weight:800; position:relative; z-index:1;">¡Gracias por tu compra!</h2>
            <p style="margin:0 0 16px; color:rgba(255,255,255,0.8); font-size:0.95rem; position:relative; z-index:1;">Tu pedido ha sido procesado exitosamente.</p>
            <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.2); border-radius:999px; padding:8px 20px; position:relative; z-index:1;">
                <i class="fas fa-hashtag" style="font-size:0.85rem; color:rgba(255,255,255,0.8);"></i>
                <span style="color:#fff; font-weight:700; font-size:0.95rem;">Orden: {{ $order->order_number }}</span>
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
