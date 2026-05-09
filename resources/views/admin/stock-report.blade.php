<x-app-layout>
<div style="display:flex; min-height:calc(100vh - 64px); background:#F4F6F9; font-family:'Outfit',sans-serif;">
    @include('admin._sidebar')
    <div style="flex:1; overflow-x:hidden;">
        <div style="background:#fff; border-bottom:3px solid #1565C0; padding:20px 32px;">
            <h1 style="margin:0; font-size:1.4rem; font-weight:800; color:#111827; display:flex; align-items:center; gap:10px;">
                <i class="fas fa-chart-bar" style="color:#1565C0;"></i> Reporte de Stock
            </h1>
            <p style="margin:4px 0 0; font-size:0.83rem; color:#6B7280;">
                <a href="{{ route('admin.dashboard') }}" style="color:#1565C0; text-decoration:none;">Dashboard</a>
                <i class="fas fa-chevron-right" style="font-size:0.7rem; margin:0 4px;"></i> Reporte de Stock
            </p>
        </div>
        <div style="padding:28px 32px;">
            <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07);">
                <div style="background:#111827; padding:16px 24px;">
                    <span style="color:#fff; font-weight:700; font-size:1rem; display:flex; align-items:center; gap:10px;">
                        <i class="fas fa-chart-bar" style="color:#1976D2;"></i> Niveles de inventario
                    </span>
                </div>
                <div style="text-align:center; padding:72px 32px;">
                    <div style="width:80px; height:80px; background:rgba(21,101,192,0.08); border-radius:20px; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
                        <i class="fas fa-chart-bar" style="font-size:2.2rem; color:#1565C0;"></i>
                    </div>
                    <h2 style="margin:0 0 10px; color:#111827; font-size:1.3rem; font-weight:700;">Reporte de inventario</h2>
                    <p style="color:#6B7280; margin:0 0 28px; max-width:400px; margin-left:auto; margin-right:auto; line-height:1.6;">
                        Aquí podrás ver niveles de stock, alertas de inventario bajo y reportes de existencias.
                    </p>
                    <a href="{{ route('admin.productos.index') }}" style="display:inline-flex; align-items:center; gap:8px; padding:11px 22px; background:#1565C0; color:#fff; border-radius:12px; text-decoration:none; font-weight:700; font-size:0.92rem; box-shadow:0 4px 16px rgba(21,101,192,0.3); transition:all .2s; margin-right:10px;" onmouseover="this.style.background='#1976D2'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#1565C0'; this.style.transform='translateY(0)'">
                        <i class="fas fa-box"></i> Ver productos
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
