<x-guest-layout>
    <!-- Use custom styles to avoid Breeze look -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <div style="display:flex; align-items:center; justify-content:center; min-height:72vh; padding:40px 16px;">
        <div class="recuadro" style="width:100%; max-width:460px;">
            @if(session('status'))
                <div style="background:rgba(255,255,255,0.04); padding:10px 12px; border-radius:8px; margin-bottom:12px; color:#fff;">{{ session('status') }}</div>
            @endif

            <div style="text-align:center; margin-bottom:12px;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:64px; display:block; margin:0 auto 8px;" />
                <h3 style="color:#ffd54f; margin:0; font-size:1.25rem;">Bienvenido — Inicia sesión</h3>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div style="margin-bottom:12px;">
                    <label for="email" style="display:block; color:#cbd5e1; font-weight:700; margin-bottom:6px;">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="search-input" style="width:100%;" />
                    @if($errors->has('email'))
                        <div style="color:#ffb4a2; margin-top:6px; font-size:0.9rem;">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div style="margin-bottom:12px;">
                    <label for="password" style="display:block; color:#cbd5e1; font-weight:700; margin-bottom:6px;">Contraseña</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password" class="search-input" style="width:100%;" />
                    @if($errors->has('password'))
                        <div style="color:#ffb4a2; margin-top:6px; font-size:0.9rem;">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; margin-bottom:14px;">
                    <label style="display:flex; align-items:center; gap:8px; color:#cbd5e1; font-size:0.95rem;">
                        <input type="checkbox" name="remember" style="width:16px; height:16px;" />
                        <span>Recordarme</span>
                    </label>

                    <div style="text-align:right;">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="color:#cbd5e1; text-decoration:underline; font-size:0.92rem;">¿Olvidaste tu contraseña?</a>
                        @endif
                    </div>
                </div>

                <div style="display:flex; gap:12px; align-items:center; justify-content:flex-end;">
                    <a href="{{ url('/') }}" class="btn-secondary" style="flex:1; text-align:center; padding:10px 12px;">Volver</a>
                    <button type="submit" class="btn-cart" style="padding:10px 14px; border-radius:8px;">Inicia sesión</button>
                </div>

                <div style="margin-top:14px; text-align:center; color:#cbd5e1; font-size:0.92rem;">
                    ¿No tienes cuenta? <a href="{{ url('/register') }}" style="color:#ffd54f; text-decoration:underline;">Regístrate</a>
                </div>
            </form>
        </div>
    </div>

</x-guest-layout>
