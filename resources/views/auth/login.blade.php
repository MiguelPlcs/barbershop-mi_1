<x-guest-layout>

    {{-- Title --}}
    <div style="text-align:center; margin-bottom:28px;">
        <h2 style="margin:0 0 6px; color:#fff; font-size:1.6rem; font-weight:800; letter-spacing:0.02em;">
            Bienvenido de nuevo
        </h2>
        <p style="margin:0; color:rgba(255,255,255,0.45); font-size:0.92rem;">Inicia sesión en tu cuenta</p>
    </div>

    @if(session('status'))
        <div style="background:rgba(21,101,192,0.15); border:1px solid rgba(21,101,192,0.3); border-radius:10px; padding:12px 16px; margin-bottom:20px; color:#90CAF9; font-size:0.9rem;">
            <i class="fas fa-circle-info" style="margin-right:6px;"></i>{{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div style="margin-bottom:18px;">
            <label style="display:block; font-weight:600; font-size:0.88rem; color:rgba(255,255,255,0.65); margin-bottom:8px; text-transform:uppercase; letter-spacing:0.05em;">
                <i class="fas fa-envelope" style="margin-right:6px; color:#1976D2;"></i>Correo electrónico
            </label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                style="width:100%; padding:13px 16px; background:rgba(255,255,255,0.06); border:2px solid rgba(255,255,255,0.1); border-radius:12px; color:#fff; font-family:'Outfit',sans-serif; font-size:0.95rem; outline:none; transition:border-color .2s, box-shadow .2s; box-sizing:border-box;"
                onfocus="this.style.borderColor='#1565C0'; this.style.boxShadow='0 0 0 4px rgba(21,101,192,0.2)'"
                onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.boxShadow='none'"
                placeholder="tu@email.com">
            @if($errors->has('email'))
                <p style="color:#EF9A9A; font-size:0.83rem; margin:6px 0 0; display:flex; align-items:center; gap:4px;">
                    <i class="fas fa-circle-exclamation"></i> {{ $errors->first('email') }}
                </p>
            @endif
        </div>

        {{-- Password --}}
        <div style="margin-bottom:18px;">
            <label style="display:block; font-weight:600; font-size:0.88rem; color:rgba(255,255,255,0.65); margin-bottom:8px; text-transform:uppercase; letter-spacing:0.05em;">
                <i class="fas fa-lock" style="margin-right:6px; color:#1976D2;"></i>Contraseña
            </label>
            <input id="password" name="password" type="password" required autocomplete="current-password"
                style="width:100%; padding:13px 16px; background:rgba(255,255,255,0.06); border:2px solid rgba(255,255,255,0.1); border-radius:12px; color:#fff; font-family:'Outfit',sans-serif; font-size:0.95rem; outline:none; transition:border-color .2s, box-shadow .2s; box-sizing:border-box;"
                onfocus="this.style.borderColor='#1565C0'; this.style.boxShadow='0 0 0 4px rgba(21,101,192,0.2)'"
                onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.boxShadow='none'"
                placeholder="••••••••">
            @if($errors->has('password'))
                <p style="color:#EF9A9A; font-size:0.83rem; margin:6px 0 0; display:flex; align-items:center; gap:4px;">
                    <i class="fas fa-circle-exclamation"></i> {{ $errors->first('password') }}
                </p>
            @endif
        </div>

        {{-- Remember & Forgot --}}
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;">
            <label style="display:flex; align-items:center; gap:8px; cursor:pointer; color:rgba(255,255,255,0.6); font-size:0.9rem;">
                <input type="checkbox" name="remember" style="width:16px; height:16px; accent-color:#1565C0; cursor:pointer;">
                Recordarme
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="color:rgba(255,255,255,0.5); font-size:0.88rem; text-decoration:none; transition:color .2s;" onmouseover="this.style.color='#90CAF9'" onmouseout="this.style.color='rgba(255,255,255,0.5)'">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        {{-- Actions --}}
        <div style="display:flex; gap:12px;">
            <a href="{{ url('/') }}" style="flex:1; text-align:center; padding:13px; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); border-radius:12px; color:rgba(255,255,255,0.75); text-decoration:none; font-weight:600; font-size:0.95rem; transition:background .2s;" onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.06)'">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <button type="submit" style="flex:2; padding:13px; background:#1565C0; border:none; border-radius:12px; color:#fff; font-family:'Outfit',sans-serif; font-size:1rem; font-weight:700; cursor:pointer; transition:background .2s, transform .15s; box-shadow:0 4px 20px rgba(21,101,192,0.4);" onmouseover="this.style.background='#1976D2'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#1565C0'; this.style.transform='translateY(0)'">
                <i class="fas fa-right-to-bracket"></i> Iniciar sesión
            </button>
        </div>

        {{-- Register link --}}
        <p style="text-align:center; margin:20px 0 0; color:rgba(255,255,255,0.45); font-size:0.9rem;">
            ¿No tienes cuenta?
            <a href="{{ url('/register') }}" style="color:#90CAF9; text-decoration:none; font-weight:600;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#90CAF9'">
                Regístrate aquí
            </a>
        </p>
    </form>

</x-guest-layout>
