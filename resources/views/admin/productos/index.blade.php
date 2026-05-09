<x-app-layout>
<div style="display:flex; min-height:calc(100vh - 64px); background:#F4F6F9; font-family:'Outfit',sans-serif;">

    @include('admin._sidebar')

    <div style="flex:1; overflow-x:hidden;">
        {{-- Page Header --}}
        <div style="background:#fff; border-bottom:3px solid #1565C0; padding:20px 32px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
            <div>
                <h1 style="margin:0; font-size:1.4rem; font-weight:800; color:#111827; display:flex; align-items:center; gap:10px;">
                    <i class="fas fa-box" style="color:#1565C0;"></i> Gestión de Productos
                </h1>
                <p style="margin:4px 0 0; font-size:0.83rem; color:#6B7280;">
                    <a href="{{ route('admin.dashboard') }}" style="color:#1565C0; text-decoration:none;">Dashboard</a>
                    <i class="fas fa-chevron-right" style="font-size:0.7rem; margin:0 4px;"></i> Productos
                </p>
            </div>
            <a href="{{ route('admin.productos.create') }}" style="display:inline-flex; align-items:center; gap:8px; padding:10px 20px; background:#1565C0; color:#fff; border-radius:12px; text-decoration:none; font-weight:700; font-size:0.92rem; box-shadow:0 4px 16px rgba(21,101,192,0.3); transition:all .2s;" onmouseover="this.style.background='#1976D2'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#1565C0'; this.style.transform='translateY(0)'">
                <i class="fas fa-plus"></i> Nuevo Producto
            </a>
        </div>

        <div style="padding:28px 32px;">
            <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(280px,1fr)); gap:22px;">
                @forelse($productos as $producto)
                <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07); display:flex; flex-direction:column; transition:transform .2s, box-shadow .2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.07)'">

                    {{-- Image --}}
                    <div style="height:160px; background:linear-gradient(135deg,#111827,#1a2332); display:flex; align-items:center; justify-content:center; position:relative;">
                        @if($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" style="width:100%; height:100%; object-fit:cover;">
                        @else
                            <i class="fas fa-box" style="font-size:3rem; color:rgba(255,255,255,0.2);"></i>
                        @endif
                        {{-- Stock badge --}}
                        <div style="position:absolute; top:12px; right:12px;">
                            @if(($producto->stock ?? 0) <= 0)
                                <span style="background:#C62828; color:#fff; padding:4px 10px; border-radius:999px; font-size:0.75rem; font-weight:700;">Sin stock</span>
                            @elseif($producto->stock <= 5)
                                <span style="background:#F57F17; color:#fff; padding:4px 10px; border-radius:999px; font-size:0.75rem; font-weight:700;">Stock bajo</span>
                            @else
                                <span style="background:#2E7D32; color:#fff; padding:4px 10px; border-radius:999px; font-size:0.75rem; font-weight:700;">{{ $producto->stock }} uds.</span>
                            @endif
                        </div>
                    </div>

                    {{-- Info --}}
                    <div style="padding:18px 20px; flex:1; display:flex; flex-direction:column; gap:6px;">
                        <h3 style="margin:0; font-size:1rem; font-weight:700; color:#111827;">{{ $producto->nombre }}</h3>
                        <p style="margin:0; font-size:0.85rem; color:#6B7280; line-height:1.5;">{{ Str::limit($producto->descripcion ?? '', 80) }}</p>
                        @if($producto->categoria ?? false)
                            <span style="background:rgba(21,101,192,0.1); color:#1565C0; padding:3px 10px; border-radius:999px; font-size:0.75rem; font-weight:700; display:inline-block; width:fit-content;">{{ $producto->categoria }}</span>
                        @endif
                        <div style="font-size:1.3rem; font-weight:800; color:#1565C0; margin-top:4px;">${{ number_format($producto->precio, 0, ',', '.') }}</div>
                    </div>

                    {{-- Actions --}}
                    <div style="padding:14px 20px; border-top:1px solid #F4F6F9; display:flex; gap:10px;">
                        <a href="{{ route('admin.productos.edit', $producto->_id) }}" style="flex:1; display:flex; align-items:center; justify-content:center; gap:6px; padding:9px; background:#1565C0; color:#fff; border-radius:10px; text-decoration:none; font-size:0.88rem; font-weight:600; transition:background .2s;" onmouseover="this.style.background='#1976D2'" onmouseout="this.style.background='#1565C0'">
                            <i class="fas fa-pen"></i> Editar
                        </a>
                        <form action="{{ route('admin.productos.destroy', $producto->_id) }}" method="POST" style="flex:1;" data-bs-confirm="¿Seguro que deseas eliminar '{{ addslashes($producto->nombre) }}'? Esta acción no se puede deshacer." data-bs-confirm-title="Eliminar producto">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="width:100%; display:flex; align-items:center; justify-content:center; gap:6px; padding:9px; background:#C62828; color:#fff; border-radius:10px; border:none; font-size:0.88rem; font-weight:600; cursor:pointer; transition:background .2s; font-family:'Outfit',sans-serif;" onmouseover="this.style.background='#E53935'" onmouseout="this.style.background='#C62828'">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div style="grid-column:1/-1; text-align:center; padding:72px 24px; background:#fff; border-radius:16px; box-shadow:0 4px 20px rgba(0,0,0,0.07);">
                    <i class="fas fa-box-open" style="font-size:3rem; color:#E8ECF0; display:block; margin-bottom:16px;"></i>
                    <h3 style="margin:0 0 8px; color:#111827;">Sin productos</h3>
                    <p style="color:#6B7280; margin:0 0 20px;">Aún no hay productos registrados en el sistema.</p>
                    <a href="{{ route('admin.productos.create') }}" style="display:inline-flex; align-items:center; gap:8px; padding:11px 22px; background:#1565C0; color:#fff; border-radius:12px; text-decoration:none; font-weight:700;">
                        <i class="fas fa-plus"></i> Crear primer producto
                    </a>
                </div>
                @endforelse
            </div>

            {{-- Paginación --}}
            @if($productos->hasPages())
            <div style="margin-top:28px; display:flex; justify-content:center;">
                {{ $productos->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
</x-app-layout>