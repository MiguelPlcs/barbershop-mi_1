{{-- Reusable Admin Sidebar Partial --}}
<aside style="width:260px; background:#0a0a0a; flex-shrink:0; display:flex; flex-direction:column; position:sticky; top:64px; height:calc(100vh - 64px); overflow-y:auto;">

    <div style="padding:20px 16px 8px;">
        <p style="font-size:0.72rem; text-transform:uppercase; letter-spacing:0.08em; color:rgba(255,255,255,0.3); font-weight:700; padding:0 8px; margin:0 0 8px;">Principal</p>
        <a href="{{ route('admin.dashboard') }}" style="display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; {{ request()->routeIs('admin.dashboard') ? 'background:#1565C0; color:#fff; box-shadow:0 4px 16px rgba(21,101,192,0.35);' : 'color:rgba(255,255,255,0.65);' }} text-decoration:none; font-weight:{{ request()->routeIs('admin.dashboard') ? '600' : '500' }}; font-size:0.92rem; margin-bottom:2px; transition:all .2s;" onmouseover="if(this.style.background!='#1565C0') { this.style.background='rgba(255,255,255,0.07)'; this.style.color='#fff'; }" onmouseout="if(this.style.background!='rgb(21, 101, 192)') { this.style.background='transparent'; this.style.color='rgba(255,255,255,0.65)'; }">
            <i class="fas fa-gauge" style="width:20px; text-align:center;"></i> Dashboard
        </a>
        <a href="{{ route('admin.productos.index') }}" style="display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; {{ request()->routeIs('admin.productos*') ? 'background:#1565C0; color:#fff; box-shadow:0 4px 16px rgba(21,101,192,0.35);' : 'color:rgba(255,255,255,0.65);' }} text-decoration:none; font-weight:{{ request()->routeIs('admin.productos*') ? '600' : '500' }}; font-size:0.92rem; margin-bottom:2px; transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.07)'; this.style.color='#fff'" onmouseout="if(this.style.background!='rgb(21, 101, 192)') { this.style.background='transparent'; this.style.color='rgba(255,255,255,0.65)'; }">
            <i class="fas fa-box" style="width:20px; text-align:center;"></i> Productos
        </a>
        <a href="{{ route('admin.users.index') }}" style="display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; {{ request()->routeIs('admin.users*') ? 'background:#1565C0; color:#fff; box-shadow:0 4px 16px rgba(21,101,192,0.35);' : 'color:rgba(255,255,255,0.65);' }} text-decoration:none; font-weight:{{ request()->routeIs('admin.users*') ? '600' : '500' }}; font-size:0.92rem; margin-bottom:2px; transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.07)'; this.style.color='#fff'" onmouseout="if(this.style.background!='rgb(21, 101, 192)') { this.style.background='transparent'; this.style.color='rgba(255,255,255,0.65)'; }">
            <i class="fas fa-users" style="width:20px; text-align:center;"></i> Usuarios
        </a>
    </div>

    <div style="padding:16px 16px 8px; border-top:1px solid rgba(255,255,255,0.06);">
        <p style="font-size:0.72rem; text-transform:uppercase; letter-spacing:0.08em; color:rgba(255,255,255,0.3); font-weight:700; padding:0 8px; margin:0 0 8px;">Operaciones</p>
        <a href="{{ route('admin.orders.index') }}" style="display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; {{ request()->routeIs('admin.orders*') ? 'background:#1565C0; color:#fff;' : 'color:rgba(255,255,255,0.65);' }} text-decoration:none; font-size:0.92rem; font-weight:500; margin-bottom:2px; transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.07)'; this.style.color='#fff'" onmouseout="if(this.style.background!='rgb(21, 101, 192)') { this.style.background='transparent'; this.style.color='rgba(255,255,255,0.65)'; }">
            <i class="fas fa-receipt" style="width:20px; text-align:center;"></i> Pedidos
        </a>
        <a href="{{ route('admin.shipments.index') }}" style="display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; {{ request()->routeIs('admin.shipments*') ? 'background:#1565C0; color:#fff;' : 'color:rgba(255,255,255,0.65);' }} text-decoration:none; font-size:0.92rem; font-weight:500; margin-bottom:2px; transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.07)'; this.style.color='#fff'" onmouseout="if(this.style.background!='rgb(21, 101, 192)') { this.style.background='transparent'; this.style.color='rgba(255,255,255,0.65)'; }">
            <i class="fas fa-truck" style="width:20px; text-align:center;"></i> Envíos
        </a>
        <a href="{{ route('admin.returns.index') }}" style="display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; {{ request()->routeIs('admin.returns*') ? 'background:#1565C0; color:#fff;' : 'color:rgba(255,255,255,0.65);' }} text-decoration:none; font-size:0.92rem; font-weight:500; margin-bottom:2px; transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.07)'; this.style.color='#fff'" onmouseout="if(this.style.background!='rgb(21, 101, 192)') { this.style.background='transparent'; this.style.color='rgba(255,255,255,0.65)'; }">
            <i class="fas fa-rotate-left" style="width:20px; text-align:center;"></i> Devoluciones
        </a>
        <a href="{{ route('admin.stock.report') }}" style="display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; {{ request()->routeIs('admin.stock*') ? 'background:#1565C0; color:#fff;' : 'color:rgba(255,255,255,0.65);' }} text-decoration:none; font-size:0.92rem; font-weight:500; margin-bottom:2px; transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.07)'; this.style.color='#fff'" onmouseout="if(this.style.background!='rgb(21, 101, 192)') { this.style.background='transparent'; this.style.color='rgba(255,255,255,0.65)'; }">
            <i class="fas fa-chart-bar" style="width:20px; text-align:center;"></i> Reporte Stock
        </a>
    </div>

    <div style="margin-top:auto; padding:16px;">
        <a href="{{ url('/') }}" style="display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:10px; color:rgba(255,255,255,0.4); text-decoration:none; font-size:0.88rem; transition:all .2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.4)'">
            <i class="fas fa-store" style="width:16px;"></i> Ver tienda
        </a>
    </div>
</aside>
