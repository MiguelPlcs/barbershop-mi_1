<x-app-layout>
<div style="background:#F4F6F9; min-height:calc(100vh - 64px); font-family:'Outfit',sans-serif;">

    <div style="background:#fff; border-bottom:3px solid #1565C0; padding:20px 32px;">
        <h1 style="margin:0; font-size:1.4rem; font-weight:800; color:#111827; display:flex; align-items:center; gap:10px;">
            <i class="fas fa-cart-shopping" style="color:#1565C0;"></i> Mi Carrito
        </h1>
    </div>

    <div style="max-width:1000px; margin:0 auto; padding:28px 24px;">

        @if(empty($cart))
            <div style="background:#fff; border-radius:16px; padding:72px 32px; text-align:center; box-shadow:0 4px 20px rgba(0,0,0,0.07);">
                <i class="fas fa-cart-shopping" style="font-size:3.5rem; color:#E8ECF0; display:block; margin-bottom:16px;"></i>
                <h2 style="margin:0 0 8px; color:#111827; font-size:1.3rem;">Tu carrito está vacío</h2>
                <p style="color:#6B7280; margin:0 0 24px;">Agrega productos para comenzar tu compra.</p>
                <a href="{{ url('/') }}" style="display:inline-flex; align-items:center; gap:8px; padding:12px 24px; background:#1565C0; color:#fff; border-radius:12px; text-decoration:none; font-weight:700; box-shadow:0 4px 16px rgba(21,101,192,0.3);">
                    <i class="fas fa-store"></i> Ver productos
                </a>
            </div>
        @else
            <div style="display:grid; grid-template-columns:1fr 320px; gap:24px; align-items:start;">

                {{-- Cart Table --}}
                <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07);">
                    <div style="background:#111827; padding:16px 24px;">
                        <span style="color:#fff; font-weight:700; font-size:1rem; display:flex; align-items:center; gap:10px;">
                            <i class="fas fa-list" style="color:#1976D2;"></i>
                            {{ count($cart) }} {{ count($cart) === 1 ? 'producto' : 'productos' }} en tu carrito
                        </span>
                    </div>
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse; font-size:0.93rem;">
                            <thead>
                                <tr style="background:#F4F6F9; border-bottom:2px solid #E8ECF0;">
                                    <th style="padding:12px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Producto</th>
                                    <th style="padding:12px 20px; text-align:right; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Precio</th>
                                    <th style="padding:12px 20px; text-align:center; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Cantidad</th>
                                    <th style="padding:12px 20px; text-align:right; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($cart as $item)
                                    @php $subtotal = $item['precio'] * $item['qty']; $total += $subtotal; @endphp
                                    <tr style="border-bottom:1px solid #F4F6F9;">
                                        <td style="padding:16px 20px;">
                                            <div style="font-weight:600; color:#111827;">{{ $item['nombre'] }}</div>
                                        </td>
                                        <td style="padding:16px 20px; text-align:right; color:#6B7280;">
                                            ${{ number_format($item['precio'], 0, ',', '.') }}
                                        </td>
                                        <td style="padding:16px 20px; text-align:center;">
                                            <span style="background:#F4F6F9; padding:5px 14px; border-radius:8px; font-weight:600; color:#374151;">{{ $item['qty'] }}</span>
                                        </td>
                                        <td style="padding:16px 20px; text-align:right; font-weight:700; color:#1565C0;">
                                            ${{ number_format($subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Summary Card --}}
                <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07); position:sticky; top:88px;">
                    <div style="background:#1565C0; padding:16px 24px;">
                        <span style="color:#fff; font-weight:700; font-size:1rem; display:flex; align-items:center; gap:10px;">
                            <i class="fas fa-receipt"></i> Resumen del pedido
                        </span>
                    </div>
                    <div style="padding:20px 24px;">
                        <div style="display:flex; justify-content:space-between; margin-bottom:10px; font-size:0.92rem; color:#6B7280;">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; margin-bottom:10px; font-size:0.92rem; color:#6B7280;">
                            <span>Envío</span>
                            <span style="color:#2E7D32; font-weight:600;">Gratis</span>
                        </div>
                        <div style="height:1px; background:#F4F6F9; margin:14px 0;"></div>
                        <div style="display:flex; justify-content:space-between; font-size:1.15rem; font-weight:800; color:#111827; margin-bottom:20px;">
                            <span>Total</span>
                            <span style="color:#1565C0;">${{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        @if(Auth::check())
                            <a href="{{ route('cart.payment') }}" style="display:flex; align-items:center; justify-content:center; gap:8px; width:100%; padding:14px; background:#1565C0; color:#fff; border-radius:12px; text-decoration:none; font-weight:700; font-size:1rem; box-shadow:0 4px 16px rgba(21,101,192,0.3); transition:all .2s; box-sizing:border-box;" onmouseover="this.style.background='#1976D2'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#1565C0'; this.style.transform='translateY(0)'">
                                <i class="fas fa-credit-card"></i> Proceder al pago
                            </a>
                        @else
                            <a href="{{ route('register') }}" style="display:flex; align-items:center; justify-content:center; gap:8px; width:100%; padding:13px; background:#1565C0; color:#fff; border-radius:12px; text-decoration:none; font-weight:700; font-size:0.95rem; margin-bottom:10px; box-sizing:border-box;">
                                <i class="fas fa-user-plus"></i> Registrarse para pagar
                            </a>
                            <a href="{{ route('cart.guest_invoice') }}" style="display:flex; align-items:center; justify-content:center; gap:8px; width:100%; padding:13px; background:#F4F6F9; color:#374151; border-radius:12px; text-decoration:none; font-weight:600; font-size:0.92rem; border:2px solid #E8ECF0; box-sizing:border-box;">
                                <i class="fas fa-file-invoice"></i> Factura sin registro
                            </a>
                        @endif

                        <a href="{{ url('/') }}" style="display:flex; align-items:center; justify-content:center; gap:6px; margin-top:12px; color:#6B7280; text-decoration:none; font-size:0.88rem;" onmouseover="this.style.color='#1565C0'" onmouseout="this.style.color='#6B7280'">
                            <i class="fas fa-arrow-left"></i> Seguir comprando
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
</x-app-layout>
