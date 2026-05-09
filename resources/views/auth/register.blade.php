<x-guest-layout>

    {{-- Title --}}
    <div style="text-align:center; margin-bottom:28px;">
        <h2 style="margin:0 0 6px; color:#fff; font-size:1.6rem; font-weight:800; letter-spacing:0.02em;">
            Crear cuenta
        </h2>
        <p style="margin:0; color:rgba(255,255,255,0.45); font-size:0.92rem;">Únete a la comunidad Barbershop</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name --}}
        <div style="margin-bottom:16px;">
            <label style="display:block; font-weight:600; font-size:0.88rem; color:rgba(255,255,255,0.65); margin-bottom:8px; text-transform:uppercase; letter-spacing:0.05em;">
                <i class="fas fa-user" style="margin-right:6px; color:#1976D2;"></i>Nombre completo
            </label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                style="width:100%; padding:13px 16px; background:rgba(255,255,255,0.06); border:2px solid rgba(255,255,255,0.1); border-radius:12px; color:#fff; font-family:'Outfit',sans-serif; font-size:0.95rem; outline:none; transition:border-color .2s; box-sizing:border-box;"
                onfocus="this.style.borderColor='#1565C0'; this.style.boxShadow='0 0 0 4px rgba(21,101,192,0.2)'"
                onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.boxShadow='none'"
                placeholder="Tu nombre">
            @if($errors->has('name'))
                <p style="color:#EF9A9A; font-size:0.83rem; margin:5px 0 0;"><i class="fas fa-circle-exclamation"></i> {{ $errors->first('name') }}</p>
            @endif
        </div>

        {{-- Email --}}
        <div style="margin-bottom:16px;">
            <label style="display:block; font-weight:600; font-size:0.88rem; color:rgba(255,255,255,0.65); margin-bottom:8px; text-transform:uppercase; letter-spacing:0.05em;">
                <i class="fas fa-envelope" style="margin-right:6px; color:#1976D2;"></i>Correo electrónico
            </label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                style="width:100%; padding:13px 16px; background:rgba(255,255,255,0.06); border:2px solid rgba(255,255,255,0.1); border-radius:12px; color:#fff; font-family:'Outfit',sans-serif; font-size:0.95rem; outline:none; transition:border-color .2s; box-sizing:border-box;"
                onfocus="this.style.borderColor='#1565C0'; this.style.boxShadow='0 0 0 4px rgba(21,101,192,0.2)'"
                onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.boxShadow='none'"
                placeholder="tu@email.com">
            @if($errors->has('email'))
                <p style="color:#EF9A9A; font-size:0.83rem; margin:5px 0 0;"><i class="fas fa-circle-exclamation"></i> {{ $errors->first('email') }}</p>
            @endif
        </div>

        {{-- Password --}}
        <div style="margin-bottom:16px;">
            <label style="display:block; font-weight:600; font-size:0.88rem; color:rgba(255,255,255,0.65); margin-bottom:8px; text-transform:uppercase; letter-spacing:0.05em;">
                <i class="fas fa-lock" style="margin-right:6px; color:#1976D2;"></i>Contraseña
            </label>
            <input id="password" name="password" type="password" required autocomplete="new-password"
                style="width:100%; padding:13px 16px; background:rgba(255,255,255,0.06); border:2px solid rgba(255,255,255,0.1); border-radius:12px; color:#fff; font-family:'Outfit',sans-serif; font-size:0.95rem; outline:none; transition:border-color .2s; box-sizing:border-box;"
                onfocus="this.style.borderColor='#1565C0'; this.style.boxShadow='0 0 0 4px rgba(21,101,192,0.2)'"
                onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.boxShadow='none'"
                placeholder="••••••••">
            @if($errors->has('password'))
                <p style="color:#EF9A9A; font-size:0.83rem; margin:5px 0 0;"><i class="fas fa-circle-exclamation"></i> {{ $errors->first('password') }}</p>
            @endif
        </div>

        {{-- Confirm Password --}}
        <div style="margin-bottom:24px;">
            <label style="display:block; font-weight:600; font-size:0.88rem; color:rgba(255,255,255,0.65); margin-bottom:8px; text-transform:uppercase; letter-spacing:0.05em;">
                <i class="fas fa-shield-halved" style="margin-right:6px; color:#1976D2;"></i>Confirmar contraseña
            </label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                style="width:100%; padding:13px 16px; background:rgba(255,255,255,0.06); border:2px solid rgba(255,255,255,0.1); border-radius:12px; color:#fff; font-family:'Outfit',sans-serif; font-size:0.95rem; outline:none; transition:border-color .2s; box-sizing:border-box;"
                onfocus="this.style.borderColor='#1565C0'; this.style.boxShadow='0 0 0 4px rgba(21,101,192,0.2)'"
                onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.boxShadow='none'"
                placeholder="••••••••">
            @if($errors->has('password_confirmation'))
                <p style="color:#EF9A9A; font-size:0.83rem; margin:5px 0 0;"><i class="fas fa-circle-exclamation"></i> {{ $errors->first('password_confirmation') }}</p>
            @endif
        </div>

        {{-- Actions --}}
        <div style="display:flex; gap:10px; margin-bottom:20px;">
            <a href="{{ url('/') }}" style="padding:13px 16px; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); border-radius:12px; color:rgba(255,255,255,0.75); text-decoration:none; font-weight:600; font-size:0.9rem; transition:background .2s; white-space:nowrap;" onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.06)'">
                <i class="fas fa-arrow-left"></i>
            </a>
            <button type="submit" style="flex:1; padding:13px; background:#1565C0; border:none; border-radius:12px; color:#fff; font-family:'Outfit',sans-serif; font-size:1rem; font-weight:700; cursor:pointer; transition:background .2s, transform .15s; box-shadow:0 4px 20px rgba(21,101,192,0.4);" onmouseover="this.style.background='#1976D2'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#1565C0'; this.style.transform='translateY(0)'">
                <i class="fas fa-user-plus"></i> Crear mi cuenta
            </button>
        </div>

        <p style="text-align:center; margin:0; color:rgba(255,255,255,0.45); font-size:0.9rem;">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" style="color:#90CAF9; text-decoration:none; font-weight:600;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#90CAF9'">
                Inicia sesión
            </a>
        </p>
    </form>

</x-guest-layout>
