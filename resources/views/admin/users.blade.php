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
                        @isset($users)
                        <span style="background:rgba(255,255,255,0.1); color:rgba(255,255,255,0.7); padding:4px 12px; border-radius:999px; font-size:0.82rem; margin-left:8px;">
                            {{ $users->total() }} usuarios
                        </span>
                        @endisset
                    </span>
                    <button onclick="openUserModal()" style="background:#1565C0; color:#fff; border:none; padding:8px 16px; border-radius:8px; font-weight:600; font-family:'Outfit',sans-serif; font-size:0.9rem; cursor:pointer; display:flex; align-items:center; gap:6px; transition:background .2s;" onmouseover="this.style.background='#1976D2'" onmouseout="this.style.background='#1565C0'">
                        <i class="fas fa-plus"></i> Nuevo usuario
                    </button>
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
                                <th style="padding:13px 20px; text-align:right; font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6B7280;">Acciones</th>
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
                                <td style="padding:14px 20px; text-align:right;">
                                    <div style="display:flex; justify-content:flex-end; gap:8px;">
                                        <button onclick="openUserModal('{{ $u->id }}', '{{ addslashes($u->name) }}', '{{ addslashes($u->email) }}', '{{ $u->role ?? 'user' }}')" style="background:rgba(21,101,192,0.1); color:#1565C0; border:none; width:32px; height:32px; border-radius:8px; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all .2s;" onmouseover="this.style.background='#1565C0'; this.style.color='#fff'" onmouseout="this.style.background='rgba(21,101,192,0.1)'; this.style.color='#1565C0'" title="Editar">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        @if(auth()->id() != $u->id)
                                        <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" data-bs-confirm="¿Eliminar a este usuario de forma permanente?" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background:rgba(198,40,40,0.1); color:#C62828; border:none; width:32px; height:32px; border-radius:8px; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all .2s;" onmouseover="this.style.background='#C62828'; this.style.color='#fff'" onmouseout="this.style.background='rgba(198,40,40,0.1)'; this.style.color='#C62828'" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
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

{{-- User Modal (Crear / Editar) --}}
<div class="bs-modal-overlay" id="user-modal-overlay" onclick="if(event.target === this) closeUserModal()">
    <div class="bs-modal" style="max-width:500px;">
        <div class="bs-modal-header" style="background:#111827; color:#fff;">
            <div class="modal-icon" style="background:rgba(255,255,255,0.1); color:#fff;"><i class="fas fa-user"></i></div>
            <div>
                <h3 id="user-modal-title" style="color:#fff;">Nuevo Usuario</h3>
            </div>
            <button onclick="closeUserModal()" style="background:transparent; border:none; color:rgba(255,255,255,0.5); cursor:pointer; font-size:1.2rem; margin-left:auto;"><i class="fas fa-times"></i></button>
        </div>
        
        <form id="user-form" method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <input type="hidden" name="_method" id="user-method" value="POST">
            
            <div class="bs-modal-body" style="padding:24px;">
                <div class="bs-form-group">
                    <label class="bs-form-label">Nombre</label>
                    <input type="text" name="name" id="user-name" class="bs-form-input" required>
                </div>
                
                <div class="bs-form-group">
                    <label class="bs-form-label">Correo electrónico</label>
                    <input type="email" name="email" id="user-email" class="bs-form-input" required>
                </div>

                <div class="bs-form-group">
                    <label class="bs-form-label">Rol</label>
                    <select name="role" id="user-role" class="bs-form-input" required>
                        <option value="user">Usuario normal</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <div class="bs-form-group">
                    <label class="bs-form-label">Contraseña <span id="user-pw-help" style="font-weight:normal; color:#6B7280; font-size:0.8rem;"></span></label>
                    <input type="password" name="password" id="user-password" class="bs-form-input">
                </div>

                <div class="bs-form-group" style="margin-bottom:0;">
                    <label class="bs-form-label">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="user-password-confirm" class="bs-form-input">
                </div>
            </div>

            <div class="bs-modal-footer">
                <button type="button" onclick="closeUserModal()" class="bs-btn bs-btn-secondary">Cancelar</button>
                <button type="submit" class="bs-btn bs-btn-primary"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
function openUserModal(id = null, name = '', email = '', role = 'user') {
    const overlay = document.getElementById('user-modal-overlay');
    const form = document.getElementById('user-form');
    const title = document.getElementById('user-modal-title');
    const methodInput = document.getElementById('user-method');
    const pwHelp = document.getElementById('user-pw-help');
    const pwInput = document.getElementById('user-password');
    const pwConfirm = document.getElementById('user-password-confirm');

    document.getElementById('user-name').value = name;
    document.getElementById('user-email').value = email;
    document.getElementById('user-role').value = role;
    pwInput.value = '';
    pwConfirm.value = '';

    if (id) {
        title.textContent = 'Editar Usuario';
        form.action = `{{ url('admin/users') }}/${id}`;
        methodInput.value = 'PUT';
        pwHelp.textContent = '(Dejar en blanco para mantener la actual)';
        pwInput.removeAttribute('required');
        pwConfirm.removeAttribute('required');
    } else {
        title.textContent = 'Nuevo Usuario';
        form.action = `{{ route('admin.users.store') }}`;
        methodInput.value = 'POST';
        pwHelp.textContent = '*';
        pwInput.setAttribute('required', 'required');
        pwConfirm.setAttribute('required', 'required');
    }

    overlay.classList.add('active');
}

function closeUserModal() {
    document.getElementById('user-modal-overlay').classList.remove('active');
}

// Show validation errors if they exist and open modal again
@if($errors->any())
    document.addEventListener('DOMContentLoaded', () => {
        openUserModal(); // Just open it back so they see the errors
        bsToast('Por favor, corrige los errores del formulario', 'error');
    });
@endif
</script>

</x-app-layout>
