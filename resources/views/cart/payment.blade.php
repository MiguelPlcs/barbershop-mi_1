<x-app-layout>
<div style="background:#F4F6F9; min-height:calc(100vh - 64px); font-family:'Outfit',sans-serif;">

    <div style="background:#fff; border-bottom:3px solid #1565C0; padding:20px 32px;">
        <h1 style="margin:0; font-size:1.4rem; font-weight:800; color:#111827; display:flex; align-items:center; gap:10px;">
            <i class="fas fa-credit-card" style="color:#1565C0;"></i> Datos de pago
        </h1>
        {{-- Steps --}}
        <div style="display:flex; align-items:center; gap:0; margin-top:14px;">
            <div style="display:flex; align-items:center; gap:8px;">
                <div style="width:28px; height:28px; border-radius:50%; background:#E8ECF0; color:#6B7280; display:flex; align-items:center; justify-content:center; font-size:0.8rem; font-weight:700;">✓</div>
                <span style="font-size:0.85rem; color:#6B7280;">Carrito</span>
            </div>
            <div style="width:40px; height:2px; background:#E8ECF0; margin:0 8px;"></div>
            <div style="display:flex; align-items:center; gap:8px;">
                <div style="width:28px; height:28px; border-radius:50%; background:#1565C0; color:#fff; display:flex; align-items:center; justify-content:center; font-size:0.8rem; font-weight:700;">2</div>
                <span style="font-size:0.85rem; color:#1565C0; font-weight:700;">Pago</span>
            </div>
            <div style="width:40px; height:2px; background:#E8ECF0; margin:0 8px;"></div>
            <div style="display:flex; align-items:center; gap:8px;">
                <div style="width:28px; height:28px; border-radius:50%; background:#E8ECF0; color:#9AA7B6; display:flex; align-items:center; justify-content:center; font-size:0.8rem; font-weight:700;">3</div>
                <span style="font-size:0.85rem; color:#9AA7B6;">Confirmación</span>
            </div>
        </div>
    </div>

    <div style="max-width:960px; margin:0 auto; padding:28px 24px;">

        @if(empty($cart))
            <div style="background:#fff; border-radius:16px; padding:48px 32px; text-align:center; box-shadow:0 4px 20px rgba(0,0,0,0.07);">
                <i class="fas fa-cart-shopping" style="font-size:3rem; color:#E8ECF0; display:block; margin-bottom:14px;"></i>
                <p style="color:#6B7280; margin:0 0 20px;">No hay productos en el carrito.</p>
                <a href="{{ url('/') }}" style="display:inline-flex; align-items:center; gap:8px; padding:11px 22px; background:#1565C0; color:#fff; border-radius:12px; text-decoration:none; font-weight:700;">
                    <i class="fas fa-store"></i> Ver tienda
                </a>
            </div>
        @else
            <div style="display:grid; grid-template-columns:1fr 340px; gap:24px; align-items:start;">

                {{-- Payment Form --}}
                <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07);">
                    <div style="background:#111827; padding:16px 24px;">
                        <span style="color:#fff; font-weight:700; font-size:1rem; display:flex; align-items:center; gap:10px;">
                            <i class="fas fa-user" style="color:#1976D2;"></i> Información de pago
                        </span>
                    </div>
                    <div style="padding:28px;">
                        <form action="{{ route('cart.process_payment') }}" method="POST">
                            @csrf

                            @if(session('error'))
                                <div style="background:rgba(198,40,40,0.08); border:1px solid rgba(198,40,40,0.25); border-radius:12px; padding:14px 18px; margin-bottom:22px; color:#C62828; font-size:0.9rem; display:flex; align-items:center; gap:10px;">
                                    <i class="fas fa-circle-exclamation"></i> {{ session('error') }}
                                </div>
                            @endif

                            <div style="margin-bottom:20px;">
                                <label style="display:block; font-weight:600; font-size:0.88rem; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.04em;">
                                    <i class="fas fa-user" style="color:#1565C0; margin-right:5px;"></i> Nombre completo *
                                </label>
                                <input name="payer_name" type="text" required placeholder="Tu nombre completo"
                                    value="{{ Auth::user()->name ?? '' }}"
                                    style="width:100%; padding:13px 16px; border:2px solid #E8ECF0; border-radius:12px; font-family:'Outfit',sans-serif; font-size:0.95rem; color:#111827; outline:none; box-sizing:border-box; transition:border-color .2s;"
                                    onfocus="this.style.borderColor='#1565C0'; this.style.boxShadow='0 0 0 4px rgba(21,101,192,0.12)'"
                                    onblur="this.style.borderColor='#E8ECF0'; this.style.boxShadow='none'">
                            </div>

                            <div style="margin-bottom:28px;">
                                <label style="display:block; font-weight:600; font-size:0.88rem; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.04em;">
                                    <i class="fas fa-wallet" style="color:#1565C0; margin-right:5px;"></i> Método de pago *
                                </label>
                                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:12px;">
                                    @foreach([['tarjeta','fa-credit-card','Tarjeta'],['efectivo','fa-money-bill','Efectivo'],['transferencia','fa-building-columns','Transferencia']] as $m)
                                    <label style="cursor:pointer;">
                                        <input type="radio" name="payment_method" value="{{ $m[0] }}" required style="display:none;" onchange="document.querySelectorAll('.pay-opt').forEach(e=>e.style.borderColor='#E8ECF0'); this.closest('.pay-opt').style.borderColor='#1565C0'; this.closest('.pay-opt').style.background='rgba(21,101,192,0.05)';">
                                        <div class="pay-opt" style="border:2px solid #E8ECF0; border-radius:12px; padding:16px 12px; text-align:center; transition:all .2s;" onmouseover="this.style.borderColor='#1565C0'" onmouseout="">
                                            <i class="fas {{ $m[1] }}" style="font-size:1.5rem; color:#1565C0; display:block; margin-bottom:8px;"></i>
                                            <span style="font-size:0.88rem; font-weight:600; color:#374151;">{{ $m[2] }}</span>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <div style="display:flex; gap:12px;">
                                <a href="{{ route('cart.index') }}" style="display:inline-flex; align-items:center; gap:8px; padding:12px 20px; background:#F4F6F9; color:#374151; border-radius:12px; text-decoration:none; font-weight:600; border:2px solid #E8ECF0; transition:all .2s;" onmouseover="this.style.background='#E8ECF0'" onmouseout="this.style.background='#F4F6F9'">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                                <button type="submit" style="flex:1; display:inline-flex; align-items:center; justify-content:center; gap:8px; padding:13px 20px; background:#1565C0; color:#fff; border-radius:12px; border:none; font-family:'Outfit',sans-serif; font-size:1rem; font-weight:700; cursor:pointer; box-shadow:0 4px 16px rgba(21,101,192,0.3); transition:all .2s;" onmouseover="this.style.background='#1976D2'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#1565C0'; this.style.transform='translateY(0)'">
                                    <i class="fas fa-lock"></i> Confirmar y pagar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Order Summary --}}
                <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07); position:sticky; top:88px;">
                    <div style="background:#1565C0; padding:16px 24px;">
                        <span style="color:#fff; font-weight:700; font-size:1rem; display:flex; align-items:center; gap:10px;">
                            <i class="fas fa-receipt"></i> Tu pedido
                        </span>
                    </div>
                    <div style="padding:20px 24px;">
                        @foreach($cart as $item)
                        <div style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid #F4F6F9; font-size:0.9rem;">
                            <div>
                                <div style="font-weight:600; color:#111827;">{{ $item['nombre'] }}</div>
                                <div style="color:#9AA7B6; font-size:0.82rem;">x{{ $item['qty'] }}</div>
                            </div>
                            <span style="font-weight:700; color:#1565C0;">${{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                        <div style="display:flex; justify-content:space-between; font-size:1.1rem; font-weight:800; color:#111827; margin-top:16px; padding-top:12px; border-top:2px solid #E8ECF0;">
                            <span>Total</span>
                            <span style="color:#1565C0;">${{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
</x-app-layout>
