<x-app-layout>
<div style="background:#F4F6F9; min-height:calc(100vh - 64px); font-family:'Outfit',sans-serif;">

    <div style="background:#fff; border-bottom:3px solid #1565C0; padding:20px 32px;">
        <h1 style="margin:0; font-size:1.4rem; font-weight:800; color:#111827; display:flex; align-items:center; gap:10px;">
            <i class="fas fa-user-circle" style="color:#1565C0;"></i> Mi Perfil
        </h1>
        <p style="margin:4px 0 0; font-size:0.85rem; color:#6B7280;">
            Administra tu información personal y opciones de seguridad.
        </p>
    </div>

    <div style="max-width:960px; margin:0 auto; padding:28px 24px; display:flex; flex-direction:column; gap:24px;">

        {{-- Update Profile Information --}}
        <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07);">
            <div style="background:#111827; padding:16px 24px; display:flex; align-items:center; gap:10px;">
                <i class="fas fa-address-card" style="color:#1976D2;"></i>
                <span style="color:#fff; font-weight:700; font-size:1rem;">Información del Perfil</span>
            </div>
            <div style="padding:28px; max-width:600px;">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Update Password --}}
        <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07);">
            <div style="background:#111827; padding:16px 24px; display:flex; align-items:center; gap:10px;">
                <i class="fas fa-lock" style="color:#1976D2;"></i>
                <span style="color:#fff; font-weight:700; font-size:1rem;">Seguridad y Contraseña</span>
            </div>
            <div style="padding:28px; max-width:600px;">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Delete Account --}}
        <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07); border-bottom:3px solid #C62828;">
            <div style="background:#111827; padding:16px 24px; display:flex; align-items:center; gap:10px;">
                <i class="fas fa-user-xmark" style="color:#C62828;"></i>
                <span style="color:#fff; font-weight:700; font-size:1rem;">Zona de peligro</span>
            </div>
            <div style="padding:28px; max-width:600px;">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</div>

<style>
/* Style overrides for profile partials to match new design system */
.profile-form-section header h2 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #111827;
    margin-top: 0;
}
.profile-form-section header p {
    color: #6B7280;
    font-size: 0.9rem;
}
.profile-form-section input[type="text"],
.profile-form-section input[type="email"],
.profile-form-section input[type="password"] {
    width: 100%; padding: 13px 16px; border: 2px solid #E8ECF0; border-radius: 12px;
    font-family: 'Outfit', sans-serif; font-size: 0.95rem; color: #111827;
    background: #fff; outline: none; box-sizing: border-box; transition: border-color .2s;
    margin-top: 6px;
}
.profile-form-section input:focus {
    border-color: #1565C0;
    box-shadow: 0 0 0 4px rgba(21,101,192,0.12);
}
.profile-form-section label {
    font-weight: 600; font-size: 0.88rem; color: #374151;
    text-transform: uppercase; letter-spacing: 0.04em;
}
.profile-form-section .btn-save {
    padding: 12px 28px; background: #111827; color: #fff; border-radius: 12px;
    border: none; font-family: 'Outfit', sans-serif; font-size: 1rem; font-weight: 700;
    cursor: pointer; transition: background .2s, transform .15s;
    margin-top: 16px;
}
.profile-form-section .btn-save:hover {
    background: #1a2332; transform: translateY(-2px);
}
.profile-form-section .btn-danger {
    padding: 12px 28px; background: #C62828; color: #fff; border-radius: 12px;
    border: none; font-family: 'Outfit', sans-serif; font-size: 1rem; font-weight: 700;
    cursor: pointer; transition: background .2s, transform .15s;
    margin-top: 16px;
}
.profile-form-section .btn-danger:hover {
    background: #E53935; transform: translateY(-2px);
}
</style>

<script>
// Wrap the content of partials with our styling class
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.max-w-xl');
    sections.forEach(s => s.classList.add('profile-form-section'));

    // Update buttons
    document.querySelectorAll('.profile-form-section button').forEach(btn => {
        if(btn.closest('form') && btn.closest('form').action.includes('destroy')) {
            btn.className = 'btn-danger';
        } else if (btn.type === 'submit') {
            btn.className = 'btn-save';
        }
    });
});
</script>
</x-app-layout>
