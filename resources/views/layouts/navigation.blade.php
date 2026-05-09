<nav class="bs-navbar" x-data="{ open: false }">
    <div class="bs-navbar-inner">

        {{-- Brand --}}
        <a href="{{ url('/') }}" class="bs-navbar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>Barbershop</span>
        </a>

        {{-- Desktop Actions --}}
        <div class="bs-navbar-actions">
            
            {{-- Cart (Visible for all except admins) --}}
            @if(!(Auth::check() && Auth::user()->role === 'admin'))
                <button id="cart-toggle" style="background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.1); color:#fff; padding:9px 16px; border-radius:10px; cursor:pointer; font-size:0.9rem; font-family:'Outfit',sans-serif; font-weight:600; display:flex; align-items:center; gap:8px; transition:background .2s;" onmouseover="this.style.background='rgba(21,101,192,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.07)'">
                    <i class="fas fa-cart-shopping"></i>
                    Carrito
                    <span class="cart-count bs-cart-badge">0</span>
                </button>
                <div class="bs-navbar-divider"></div>
            @endif

            @auth
                {{-- User dropdown --}}
                <div style="position:relative;" x-data="{ drop: false }">
                    <button @click="drop = !drop" style="background:transparent; border:none; cursor:pointer; display:flex; align-items:center; gap:10px; color:#fff; font-family:'Outfit',sans-serif; font-size:0.95rem; font-weight:600; padding:8px 14px; border-radius:10px; transition:background .2s;" @mouseenter="$el.style.background='rgba(255,255,255,0.07)'" @mouseleave="if(!drop) $el.style.background='transparent'">
                        <div class="bs-navbar-user">
                            <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                            {{ Auth::user()->name }}
                        </div>
                        <i class="fas fa-chevron-down" style="font-size:0.75rem; opacity:0.7;"></i>
                    </button>
                    <div x-show="drop" @click.away="drop = false" x-transition
                        style="position:absolute; right:0; top:calc(100% + 8px); background:#1a2332; border:1px solid rgba(255,255,255,0.08); border-radius:12px; min-width:200px; box-shadow:0 16px 48px rgba(0,0,0,0.5); z-index:600; overflow:hidden;">
                        <div style="padding:12px 16px; border-bottom:1px solid rgba(255,255,255,0.06); font-size:0.82rem; color:rgba(255,255,255,0.45);">
                            {{ Auth::user()->email }}
                        </div>
                        <a href="{{ route('profile.edit') }}" style="display:flex; align-items:center; gap:10px; padding:12px 16px; color:rgba(255,255,255,0.85); text-decoration:none; font-size:0.9rem; transition:background .18s;" onmouseover="this.style.background='rgba(255,255,255,0.06)'" onmouseout="this.style.background='transparent'">
                            <i class="fas fa-user" style="width:16px; color:#1976D2;"></i> Perfil
                        </a>
                        @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" style="display:flex; align-items:center; gap:10px; padding:12px 16px; color:rgba(255,255,255,0.85); text-decoration:none; font-size:0.9rem; transition:background .18s;" onmouseover="this.style.background='rgba(255,255,255,0.06)'" onmouseout="this.style.background='transparent'">
                            <i class="fas fa-gauge" style="width:16px; color:#C62828;"></i> Dashboard
                        </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" style="display:flex; align-items:center; gap:10px; width:100%; padding:12px 16px; background:transparent; border:none; border-top:1px solid rgba(255,255,255,0.06); color:rgba(255,255,255,0.85); font-size:0.9rem; cursor:pointer; font-family:'Outfit',sans-serif; transition:background .18s;" onmouseover="this.style.background='rgba(198,40,40,0.12)'" onmouseout="this.style.background='transparent'">
                                <i class="fas fa-right-from-bracket" style="width:16px; color:#E53935;"></i> Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ url('/') }}" class="bs-navbar-link"><i class="fas fa-home"></i> Inicio</a>
                <a href="{{ route('login') }}" style="background:#1565C0; color:#fff; padding:9px 18px; border-radius:10px; text-decoration:none; font-weight:600; font-size:0.9rem; transition:background .2s; display:inline-flex; align-items:center; gap:8px;" onmouseover="this.style.background='#1976D2'" onmouseout="this.style.background='#1565C0'">
                    <i class="fas fa-right-to-bracket"></i> Iniciar sesión
                </a>
            @endauth
        </div>
    </div>
</nav>
