<x-app-layout>
<div style="display:flex; min-height:calc(100vh - 64px); background:#F4F6F9; font-family:'Outfit',sans-serif;">
    @include('admin._sidebar')
    <div style="flex:1; overflow-x:hidden;">
        <div style="background:#fff; border-bottom:3px solid #1565C0; padding:20px 32px;">
            <h1 style="margin:0; font-size:1.4rem; font-weight:800; color:#111827; display:flex; align-items:center; gap:10px;">
                <i class="fas fa-rotate-left" style="color:#1565C0;"></i> Gestionar Devoluciones
            </h1>
            <p style="margin:4px 0 0; font-size:0.83rem; color:#6B7280;">
                <a href="{{ route('admin.dashboard') }}" style="color:#1565C0; text-decoration:none;">Dashboard</a>
                <i class="fas fa-chevron-right" style="font-size:0.7rem; margin:0 4px;"></i> Devoluciones
            </p>
        </div>
        <div style="padding:28px 32px;">
            <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07);">
                <div style="background:#111827; padding:16px 24px;">
                    <span style="color:#fff; font-weight:700; font-size:1rem; display:flex; align-items:center; gap:10px;">
                        <i class="fas fa-rotate-left" style="color:#1976D2;"></i> Solicitudes de devolución
                    </span>
                </div>
                <div style="text-align:center; padding:72px 32px;">
                    <div style="width:80px; height:80px; background:rgba(245,127,23,0.08); border-radius:20px; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
                        <i class="fas fa-rotate-left" style="font-size:2.2rem; color:#F57F17;"></i>
                    </div>
                    <h2 style="margin:0 0 10px; color:#111827; font-size:1.3rem; font-weight:700;">Módulo de devoluciones</h2>
                    <p style="color:#6B7280; margin:0 0 28px; max-width:400px; margin-left:auto; margin-right:auto; line-height:1.6;">
                        Aquí podrás revisar y gestionar las solicitudes de devolución de productos.
                    </p>
                    <span style="display:inline-flex; align-items:center; gap:8px; padding:10px 20px; background:rgba(21,101,192,0.08); color:#1565C0; border-radius:999px; font-size:0.88rem; font-weight:600;">
                        <i class="fas fa-clock"></i> Próximamente disponible
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
