<x-app-layout>
<div style="display:flex; min-height:calc(100vh - 64px); background:#F4F6F9; font-family:'Outfit',sans-serif;">
    @include('admin._sidebar')
    <div style="flex:1; overflow-x:hidden;">
        <div style="background:#fff; border-bottom:3px solid #1565C0; padding:20px 32px;">
            <h1 style="margin:0; font-size:1.4rem; font-weight:800; color:#111827; display:flex; align-items:center; gap:10px;">
                <i class="fas fa-truck" style="color:#1565C0;"></i> Gestionar Envíos
            </h1>
            <p style="margin:4px 0 0; font-size:0.83rem; color:#6B7280;">
                <a href="{{ route('admin.dashboard') }}" style="color:#1565C0; text-decoration:none;">Dashboard</a>
                <i class="fas fa-chevron-right" style="font-size:0.7rem; margin:0 4px;"></i> Envíos
            </p>
        </div>
        <div style="padding:28px 32px;">
            <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07);">
                <div style="background:#111827; padding:16px 24px; display:flex; align-items:center; justify-content:space-between;">
                    <span style="color:#fff; font-weight:700; font-size:1rem; display:flex; align-items:center; gap:10px;">
                        <i class="fas fa-truck" style="color:#1976D2;"></i> Seguimiento de envíos
                    </span>
                    @isset($orders)
                    <span style="background:rgba(255,255,255,0.1); color:rgba(255,255,255,0.7); padding:4px 12px; border-radius:999px; font-size:0.82rem;">
                        {{ $orders->total() }} pedidos
                    </span>
                    @endisset
                </div>

                @if(isset($orders) && $orders->count() > 0)
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; font-size:0.93rem;">
                        <thead>
                            <tr style="background:#F4F6F9; border-bottom:2px solid #E8ECF0;">
                                <th style="padding:13px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">N° Orden</th>
                                <th style="padding:13px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Cliente</th>
                                <th style="padding:13px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Fecha</th>
                                <th style="padding:13px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Estado Actual</th>
                                <th style="padding:13px 20px; text-align:center; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Gestión Envío</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $o)
                            <tr style="border-bottom:1px solid #F4F6F9; transition:background .15s;" onmouseover="this.style.background='#F9FAFB'" onmouseout="this.style.background='transparent'">
                                <td style="padding:14px 20px; font-weight:700; color:#111827;">{{ $o->order_number }}</td>
                                <td style="padding:14px 20px; color:#6B7280;">
                                    {{ $o->payer_name ?? ($o->user ? $o->user->name : 'N/A') }}
                                </td>
                                <td style="padding:14px 20px; color:#6B7280;">{{ $o->created_at->format('d/m/Y H:i') }}</td>
                                <td style="padding:14px 20px;">
                                    @php
                                        $status = strtolower($o->status ?? 'pendiente');
                                        $bg = 'rgba(21,101,192,0.1)'; $col = '#1565C0';
                                        if($status == 'confirmado') { $bg = 'rgba(245,127,23,0.1)'; $col = '#F57F17'; }
                                        if($status == 'enviado') { $bg = 'rgba(2,136,209,0.1)'; $col = '#0288D1'; }
                                        if($status == 'punto de entrega fisico') { $bg = 'rgba(46,125,50,0.1)'; $col = '#2E7D32'; }
                                        if($status == 'cancelado') { $bg = 'rgba(198,40,40,0.1)'; $col = '#C62828'; }
                                    @endphp
                                    <span style="background:{{ $bg }}; color:{{ $col }}; padding:4px 12px; border-radius:999px; font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.04em;">
                                        {{ $o->status ?? 'Pendiente' }}
                                    </span>
                                </td>
                                <td style="padding:14px 20px; text-align:center;">
                                    @if(in_array($o->status, ['Confirmado', 'Enviado', 'Punto de entrega fisico']))
                                    <form action="{{ route('admin.orders.status.update', $o->id) }}" method="POST" style="display:flex; align-items:center; gap:8px; justify-content:center; margin:0;">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" style="padding:6px 10px; border-radius:8px; border:1px solid #E8ECF0; background:#fff; font-family:'Outfit',sans-serif; font-size:0.85rem; color:#374151; outline:none;">
                                            <option value="Confirmado" {{ $o->status == 'Confirmado' ? 'selected' : '' }}>Confirmado</option>
                                            <option value="Enviado" {{ $o->status == 'Enviado' ? 'selected' : '' }}>Enviado</option>
                                            <option value="Punto de entrega fisico" {{ $o->status == 'Punto de entrega fisico' ? 'selected' : '' }}>Punto de entrega fisico</option>
                                            <option value="Cancelado" {{ $o->status == 'Cancelado' ? 'selected' : '' }}>Cancelar Pedido</option>
                                        </select>
                                        <button type="submit" style="background:#1565C0; color:#fff; border:none; padding:6px 12px; border-radius:8px; font-weight:600; font-family:'Outfit',sans-serif; font-size:0.85rem; cursor:pointer; transition:background .2s;" onmouseover="this.style.background='#1976D2'" onmouseout="this.style.background='#1565C0'" title="Actualizar envío">
                                            <i class="fas fa-truck"></i>
                                        </button>
                                    </form>
                                    @else
                                    <span style="font-size:0.8rem; color:#9AA7B6; font-weight:600;">
                                        <i class="fas fa-lock"></i> Ver en {{ ($o->status == 'Cancelado') ? 'Devoluciones' : 'Pedidos' }}
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="padding:16px 24px; border-top:1px solid #F4F6F9;">
                    {{ $orders->links() }}
                </div>
                @else
                <div style="text-align:center; padding:72px 32px;">
                    <div style="width:80px; height:80px; background:rgba(198,40,40,0.08); border-radius:20px; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
                        <i class="fas fa-truck" style="font-size:2.2rem; color:#C62828;"></i>
                    </div>
                    <h2 style="margin:0 0 10px; color:#111827; font-size:1.3rem; font-weight:700;">No hay envíos</h2>
                    <p style="color:#6B7280; margin:0 0 28px; max-width:400px; margin-left:auto; margin-right:auto; line-height:1.6;">
                        Aún no se han realizado pedidos en la tienda.
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>
