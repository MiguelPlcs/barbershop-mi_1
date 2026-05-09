<x-app-layout>
<div style="display:flex; min-height:calc(100vh - 64px); background:#F4F6F9; font-family:'Outfit',sans-serif;">
    @include('admin._sidebar')
    <div style="flex:1; overflow-x:hidden;">
        <div style="background:#fff; border-bottom:3px solid #1565C0; padding:20px 32px;">
            <h1 style="margin:0; font-size:1.4rem; font-weight:800; color:#111827; display:flex; align-items:center; gap:10px;">
                <i class="fas fa-users" style="color:#1565C0;"></i> Gestionar Usuarios
            </h1>
            <p style="margin:4px 0 0; font-size:0.83rem; color:#6B7280;">
                <a href="{{ route('admin.dashboard') }}" style="color:#1565C0; text-decoration:none;">Dashboard</a>
                <i class="fas fa-chevron-right" style="font-size:0.7rem; margin:0 4px;"></i> Usuarios
            </p>
        </div>

        <div style="padding:28px 32px;">
            <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07);">
                <div style="background:#111827; padding:16px 24px; display:flex; align-items:center; justify-content:space-between;">
                    <span style="color:#fff; font-weight:700; font-size:1rem; display:flex; align-items:center; gap:10px;">
                        <i class="fas fa-list" style="color:#1976D2;"></i> Lista de usuarios
                    </span>
                    @isset($users)
                    <span style="background:rgba(255,255,255,0.1); color:rgba(255,255,255,0.7); padding:4px 12px; border-radius:999px; font-size:0.82rem;">
                        {{ $users->total() }} usuarios
                    </span>
                    @endisset
                </div>

                @isset($users)
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; font-size:0.93rem;">
                        <thead>
                            <tr style="background:#F4F6F9; border-bottom:2px solid #E8ECF0;">
                                <th style="padding:13px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">#</th>
                                <th style="padding:13px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Usuario</th>
                                <th style="padding:13px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Email</th>
                                <th style="padding:13px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Rol</th>
                                <th style="padding:13px 20px; text-align:left; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $i => $u)
                            <tr style="border-bottom:1px solid #F4F6F9; transition:background .15s;" onmouseover="this.style.background='#F9FAFB'" onmouseout="this.style.background='transparent'">
                                <td style="padding:14px 20px; color:#9AA7B6; font-size:0.85rem;">{{ $users->firstItem() + $i }}</td>
                                <td style="padding:14px 20px;">
                                    <div style="display:flex; align-items:center; gap:10px;">
                                        <div style="width:36px; height:36px; border-radius:50%; background:{{ ($u->role ?? 'user') === 'admin' ? '#1565C0' : '#111827' }}; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:0.88rem; flex-shrink:0;">
                                            {{ strtoupper(substr($u->name, 0, 1)) }}
                                        </div>
                                        <span style="font-weight:600; color:#111827;">{{ $u->name }}</span>
                                    </div>
                                </td>
                                <td style="padding:14px 20px; color:#6B7280;">{{ $u->email }}</td>
                                <td style="padding:14px 20px;">
                                    @if(($u->role ?? 'user') === 'admin')
                                        <span style="background:rgba(198,40,40,0.1); color:#C62828; padding:4px 12px; border-radius:999px; font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:0.04em;">Admin</span>
                                    @else
                                        <span style="background:rgba(21,101,192,0.1); color:#1565C0; padding:4px 12px; border-radius:999px; font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:0.04em;">Usuario</span>
                                    @endif
                                </td>
                                <td style="padding:14px 20px; color:#9AA7B6; font-size:0.85rem;">
                                    {{ $u->created_at ? \Carbon\Carbon::parse($u->created_at)->format('d/m/Y') : 'N/A' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="padding:16px 24px; border-top:1px solid #F4F6F9;">
                    {{ $users->links() }}
                </div>
                @else
                <div style="text-align:center; padding:60px 24px; color:#9AA7B6;">
                    <i class="fas fa-users" style="font-size:2.5rem; display:block; margin-bottom:14px;"></i>
                    <p style="margin:0;">No hay usuarios registrados.</p>
                </div>
                @endisset
            </div>
        </div>
    </div>
</div>
</x-app-layout>
