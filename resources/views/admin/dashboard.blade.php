<x-app-layout>
@if(Auth::check() && Auth::user()->role === 'admin')

<div style="display:flex; min-height:calc(100vh - 64px); background:#F4F6F9; font-family:'Outfit',sans-serif;">

    {{-- Sidebar --}}
    <aside style="width:260px; background:#0a0a0a; flex-shrink:0; display:flex; flex-direction:column; position:sticky; top:64px; height:calc(100vh - 64px); overflow-y:auto;">

        <div style="padding:20px 16px 8px;">
            <p style="font-size:0.72rem; text-transform:uppercase; letter-spacing:0.08em; color:rgba(255,255,255,0.3); font-weight:700; padding:0 8px; margin:0 0 8px;">Principal</p>

            <a href="{{ route('admin.dashboard') }}" style="display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; background:#1565C0; color:#fff; text-decoration:none; font-weight:600; font-size:0.92rem; margin-bottom:2px; box-shadow:0 4px 16px rgba(21,101,192,0.35);">
                <i class="fas fa-gauge" style="width:20px; text-align:center;"></i> Dashboard
            </a>
            <a href="{{ route('admin.productos.index') }}" style="display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; color:rgba(255,255,255,0.65); text-decoration:none; font-weight:500; font-size:0.92rem; margin-bottom:2px; transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.07)'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='rgba(255,255,255,0.65)'">
                <i class="fas fa-box" style="width:20px; text-align:center;"></i> Productos
            </a>
            <a href="{{ route('admin.users.index') }}" style="display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; color:rgba(255,255,255,0.65); text-decoration:none; font-weight:500; font-size:0.92rem; margin-bottom:2px; transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.07)'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='rgba(255,255,255,0.65)'">
                <i class="fas fa-users" style="width:20px; text-align:center;"></i> Usuarios
            </a>
        </div>

        <div style="padding:20px 16px 8px; border-top:1px solid rgba(255,255,255,0.06);">
            <p style="font-size:0.72rem; text-transform:uppercase; letter-spacing:0.08em; color:rgba(255,255,255,0.3); font-weight:700; padding:0 8px; margin:0 0 8px;">Operaciones</p>
            <a href="{{ route('admin.orders.index') }}" style="display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; color:rgba(255,255,255,0.65); text-decoration:none; font-weight:500; font-size:0.92rem; margin-bottom:2px; transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.07)'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='rgba(255,255,255,0.65)'">
                <i class="fas fa-receipt" style="width:20px; text-align:center;"></i> Pedidos
            </a>
            <a href="{{ route('admin.shipments.index') }}" style="display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; color:rgba(255,255,255,0.65); text-decoration:none; font-weight:500; font-size:0.92rem; margin-bottom:2px; transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.07)'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='rgba(255,255,255,0.65)'">
                <i class="fas fa-truck" style="width:20px; text-align:center;"></i> Envíos
            </a>
            <a href="{{ route('admin.returns.index') }}" style="display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; color:rgba(255,255,255,0.65); text-decoration:none; font-weight:500; font-size:0.92rem; margin-bottom:2px; transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.07)'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='rgba(255,255,255,0.65)'">
                <i class="fas fa-rotate-left" style="width:20px; text-align:center;"></i> Devoluciones
            </a>
            <a href="{{ route('admin.stock.report') }}" style="display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; color:rgba(255,255,255,0.65); text-decoration:none; font-weight:500; font-size:0.92rem; margin-bottom:2px; transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.07)'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='rgba(255,255,255,0.65)'">
                <i class="fas fa-chart-bar" style="width:20px; text-align:center;"></i> Reporte Stock
            </a>
        </div>

        <div style="margin-top:auto; padding:16px;">
            <a href="{{ url('/') }}" style="display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:10px; color:rgba(255,255,255,0.45); text-decoration:none; font-size:0.88rem; transition:all .2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.45)'">
                <i class="fas fa-store" style="width:16px;"></i> Ver tienda
            </a>
        </div>
    </aside>

    {{-- Main --}}
    <div style="flex:1; overflow-x:hidden;">

        {{-- Page header --}}
        <div style="background:#fff; border-bottom:3px solid #1565C0; padding:20px 32px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
            <div>
                <h1 style="margin:0; font-size:1.5rem; font-weight:800; color:#111827; display:flex; align-items:center; gap:10px;">
                    <i class="fas fa-gauge" style="color:#1565C0;"></i> Panel de Administración
                </h1>
                <p style="margin:4px 0 0; font-size:0.85rem; color:#6B7280;">
                    Bienvenido, {{ Auth::user()->name }} — {{ now()->format('d/m/Y') }}
                </p>
            </div>
            <a href="{{ route('admin.productos.create') }}" style="display:inline-flex; align-items:center; gap:8px; padding:10px 20px; background:#1565C0; color:#fff; border-radius:12px; text-decoration:none; font-weight:700; font-size:0.92rem; box-shadow:0 4px 16px rgba(21,101,192,0.3); transition:all .2s;" onmouseover="this.style.background='#1976D2'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#1565C0'; this.style.transform='translateY(0)'">
                <i class="fas fa-plus"></i> Nuevo Producto
            </a>
        </div>

        <div style="padding:28px 32px;">

            {{-- Stat Cards --}}
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px,1fr)); gap:20px; margin-bottom:28px;">

                {{-- Productos --}}
                <div style="background:#fff; border-radius:16px; padding:24px; box-shadow:0 4px 20px rgba(0,0,0,0.07); position:relative; overflow:hidden; transition:transform .2s, box-shadow .2s; cursor:default;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.07)'">
                    <div style="width:52px; height:52px; background:rgba(21,101,192,0.1); border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:14px;">
                        <i class="fas fa-box" style="font-size:1.4rem; color:#1565C0;"></i>
                    </div>
                    <div style="font-size:2.2rem; font-weight:800; color:#111827;">{{ $productosCount ?? 0 }}</div>
                    <div style="font-size:0.88rem; color:#6B7280; font-weight:500; margin-top:2px;">Productos registrados</div>
                    <div style="position:absolute; right:-12px; bottom:-12px; width:70px; height:70px; border-radius:50%; background:rgba(21,101,192,0.06);"></div>
                </div>

                {{-- Ganancias --}}
                <div style="background:#fff; border-radius:16px; padding:24px; box-shadow:0 4px 20px rgba(0,0,0,0.07); position:relative; overflow:hidden; transition:transform .2s, box-shadow .2s; cursor:default;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.07)'">
                    <div style="width:52px; height:52px; background:rgba(46,125,50,0.1); border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:14px;">
                        <i class="fas fa-dollar-sign" style="font-size:1.4rem; color:#2E7D32;"></i>
                    </div>
                    <div style="font-size:2.2rem; font-weight:800; color:#111827;">${{ number_format($totalGanancias ?? 0, 0, ',', '.') }}</div>
                    <div style="font-size:0.88rem; color:#6B7280; font-weight:500; margin-top:2px;">Ganancias totales</div>
                    <div style="position:absolute; right:-12px; bottom:-12px; width:70px; height:70px; border-radius:50%; background:rgba(46,125,50,0.06);"></div>
                </div>

                {{-- Productos Vendidos --}}
                <a href="#sold-products-detail" style="display:block; text-decoration:none; background:#fff; border-radius:16px; padding:24px; box-shadow:0 4px 20px rgba(0,0,0,0.07); position:relative; overflow:hidden; transition:transform .2s, box-shadow .2s; cursor:pointer;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.07)'">
                    <div style="width:52px; height:52px; background:rgba(245,127,23,0.1); border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:14px;">
                        <i class="fas fa-shopping-bag" style="font-size:1.4rem; color:#F57F17;"></i>
                    </div>
                    <div style="font-size:2.2rem; font-weight:800; color:#111827;">{{ $productosVendidos ?? 0 }}</div>
                    <div style="font-size:0.88rem; color:#6B7280; font-weight:500; margin-top:2px;">Productos vendidos</div>
                    <div style="position:absolute; right:-12px; bottom:-12px; width:70px; height:70px; border-radius:50%; background:rgba(245,127,23,0.06);"></div>
                </a>

                {{-- Acceso rápido cards --}}
                <a href="{{ route('admin.orders.index') }}" style="background:linear-gradient(135deg,#1565C0,#1976D2); border-radius:16px; padding:24px; box-shadow:0 4px 20px rgba(21,101,192,0.3); color:#fff; text-decoration:none; display:block; transition:transform .2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <i class="fas fa-receipt" style="font-size:1.8rem; margin-bottom:14px; display:block; opacity:0.9;"></i>
                    <div style="font-size:1.05rem; font-weight:700;">Pedidos</div>
                    <div style="font-size:0.82rem; opacity:0.75; margin-top:4px;">Gestionar órdenes</div>
                </a>

                <a href="{{ route('admin.shipments.index') }}" style="background:linear-gradient(135deg,#C62828,#E53935); border-radius:16px; padding:24px; box-shadow:0 4px 20px rgba(198,40,40,0.3); color:#fff; text-decoration:none; display:block; transition:transform .2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <i class="fas fa-truck" style="font-size:1.8rem; margin-bottom:14px; display:block; opacity:0.9;"></i>
                    <div style="font-size:1.05rem; font-weight:700;">Envíos</div>
                    <div style="font-size:0.82rem; opacity:0.75; margin-top:4px;">Seguimiento y estado</div>
                </a>

                <a href="{{ route('admin.stock.report') }}" style="background:linear-gradient(135deg,#111827,#1a2332); border-radius:16px; padding:24px; box-shadow:0 4px 20px rgba(0,0,0,0.25); color:#fff; text-decoration:none; display:block; transition:transform .2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <i class="fas fa-chart-bar" style="font-size:1.8rem; margin-bottom:14px; display:block; opacity:0.9;"></i>
                    <div style="font-size:1.05rem; font-weight:700;">Stock</div>
                    <div style="font-size:0.82rem; opacity:0.75; margin-top:4px;">Reporte de inventario</div>
                </a>
            </div>

            {{-- Recent Products --}}
            <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07);">
                <div style="background:#111827; color:#fff; padding:16px 24px; display:flex; align-items:center; justify-content:space-between;">
                    <h2 style="margin:0; font-size:1.05rem; font-weight:700; display:flex; align-items:center; gap:10px;">
                        <i class="fas fa-clock" style="color:#1976D2;"></i> Últimos productos
                    </h2>
                    <a href="{{ route('admin.productos.index') }}" style="color:rgba(255,255,255,0.6); font-size:0.85rem; text-decoration:none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.6)'">
                        Ver todos <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; font-size:0.93rem;">
                        <thead>
                            <tr style="background:#F4F6F9; border-bottom:2px solid #E8ECF0;">
                                <th style="padding:12px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Producto</th>
                                <th style="padding:12px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Precio</th>
                                <th style="padding:12px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Stock</th>
                                <th style="padding:12px 20px; text-align:right; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($recentProductos) && $recentProductos->isNotEmpty())
                                @foreach($recentProductos as $p)
                                <tr style="border-bottom:1px solid #F4F6F9; transition:background .15s;" onmouseover="this.style.background='#F9FAFB'" onmouseout="this.style.background='transparent'">
                                    <td style="padding:14px 20px;">
                                        <div style="font-weight:600; color:#111827;">{{ $p->nombre }}</div>
                                        <div style="font-size:0.8rem; color:#9AA7B6; margin-top:2px;">{{ Str::limit($p->descripcion ?? '', 50) }}</div>
                                    </td>
                                    <td style="padding:14px 20px; font-weight:700; color:#1565C0;">${{ number_format($p->precio, 0, ',', '.') }}</td>
                                    <td style="padding:14px 20px;">
                                        @if(($p->stock ?? 0) <= 0)
                                            <span style="background:rgba(198,40,40,0.1); color:#C62828; padding:4px 10px; border-radius:999px; font-size:0.78rem; font-weight:700;">Sin stock</span>
                                        @elseif($p->stock <= 5)
                                            <span style="background:rgba(245,127,23,0.1); color:#F57F17; padding:4px 10px; border-radius:999px; font-size:0.78rem; font-weight:700;">Bajo ({{ $p->stock }})</span>
                                        @else
                                            <span style="background:rgba(46,125,50,0.1); color:#2E7D32; padding:4px 10px; border-radius:999px; font-size:0.78rem; font-weight:700;">{{ $p->stock }} uds.</span>
                                        @endif
                                    </td>
                                    <td style="padding:14px 20px; text-align:right;">
                                        <a href="{{ route('admin.productos.edit', $p->_id ?? $p->id ?? $p) }}" style="display:inline-flex; align-items:center; gap:6px; padding:6px 14px; background:#1565C0; color:#fff; border-radius:8px; text-decoration:none; font-size:0.83rem; font-weight:600; transition:background .2s;" onmouseover="this.style.background='#1976D2'" onmouseout="this.style.background='#1565C0'">
                                            <i class="fas fa-pen"></i> Editar
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" style="padding:48px; text-align:center; color:#9AA7B6;">
                                        <i class="fas fa-box-open" style="font-size:2rem; display:block; margin-bottom:12px;"></i>
                                        No hay productos registrados aún.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Sold Products Detail --}}
            <div id="sold-products-detail" style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07); margin-top:28px;">
                <div style="background:#111827; color:#fff; padding:16px 24px; display:flex; align-items:center; justify-content:space-between;">
                    <h2 style="margin:0; font-size:1.05rem; font-weight:700; display:flex; align-items:center; gap:10px;">
                        <i class="fas fa-list" style="color:#F57F17;"></i> Detalle de Productos Vendidos
                    </h2>
                </div>
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; font-size:0.93rem;">
                        <thead>
                            <tr style="background:#F4F6F9; border-bottom:2px solid #E8ECF0;">
                                <th style="padding:12px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Pedido</th>
                                <th style="padding:12px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Cliente</th>
                                <th style="padding:12px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Producto</th>
                                <th style="padding:12px 20px; text-align:center; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Cant.</th>
                                <th style="padding:12px 20px; text-align:right; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Precio Ud.</th>
                                <th style="padding:12px 20px; text-align:right; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($soldItemsDetails) && $soldItemsDetails->isNotEmpty())
                                @foreach($soldItemsDetails as $item)
                                <tr style="border-bottom:1px solid #F4F6F9; transition:background .15s;" onmouseover="this.style.background='#F9FAFB'" onmouseout="this.style.background='transparent'">
                                    <td style="padding:14px 20px;">
                                        <div style="font-weight:700; color:#111827;">#{{ $item->order_number }}</div>
                                    </td>
                                    <td style="padding:14px 20px; color:#4B5563; font-weight:500;">
                                        {{ $item->user_name }}
                                    </td>
                                    <td style="padding:14px 20px;">
                                        <div style="font-weight:600; color:#1565C0;">{{ $item->product_name }}</div>
                                    </td>
                                    <td style="padding:14px 20px; text-align:center; font-weight:700; color:#111827;">
                                        {{ $item->qty }}
                                    </td>
                                    <td style="padding:14px 20px; text-align:right; font-weight:600; color:#2E7D32;">
                                        ${{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td style="padding:14px 20px; text-align:right; color:#6B7280; font-size:0.85rem;">
                                        {{ \Carbon\Carbon::parse($item->date)->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" style="padding:48px; text-align:center; color:#9AA7B6;">
                                        <i class="fas fa-receipt" style="font-size:2rem; display:block; margin-bottom:12px;"></i>
                                        No hay productos vendidos registrados.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@else
{{-- Access Denied --}}
<div style="min-height:80vh; display:flex; align-items:center; justify-content:center; background:#F4F6F9; font-family:'Outfit',sans-serif;">
    <div style="background:#fff; border-radius:18px; padding:48px 40px; text-align:center; max-width:440px; box-shadow:0 8px 40px rgba(0,0,0,0.1); border-top:4px solid #C62828;">
        <div style="width:72px; height:72px; background:rgba(198,40,40,0.1); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
            <i class="fas fa-ban" style="font-size:2rem; color:#C62828;"></i>
        </div>
        <h2 style="margin:0 0 10px; color:#111827; font-size:1.5rem; font-weight:800;">Acceso denegado</h2>
        <p style="color:#6B7280; margin:0 0 28px; line-height:1.6;">No tienes permisos para acceder al panel de administración.</p>
        <a href="{{ url('/') }}" style="display:inline-flex; align-items:center; gap:8px; padding:12px 24px; background:#1565C0; color:#fff; border-radius:12px; text-decoration:none; font-weight:700;">
            <i class="fas fa-arrow-left"></i> Volver al inicio
        </a>
    </div>
</div>
@endif
</x-app-layout>