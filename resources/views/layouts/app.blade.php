<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Barbershop') }}</title>

        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
        <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/png">

        <!-- Google Fonts: Outfit -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')
    </head>
    <body style="margin:0; font-family:'Outfit',sans-serif; background:#F4F6F9;">

        {{-- Navbar --}}
        @if (empty($hideNav))
            @include('layouts.navigation')
        @endif

        {{-- Page Content --}}
        <main>
            {{ $slot }}
        </main>

        {{-- Mini-cart Drawer --}}
        <div class="bs-drawer-overlay" id="mini-cart-overlay" onclick="closeMiniCart()"></div>
        <aside class="bs-drawer" id="mini-cart-drawer" aria-hidden="true">
            <div class="bs-drawer-header">
                <h3><i class="fas fa-cart-shopping" style="color:#1565C0; margin-right:8px;"></i> Carrito</h3>
                <button class="bs-drawer-close" id="mini-cart-close" onclick="closeMiniCart()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="bs-drawer-body" id="mini-cart-items">
                <div style="text-align:center; padding:40px 0; color:rgba(255,255,255,0.4);">
                    <i class="fas fa-cart-shopping" style="font-size:2rem; margin-bottom:12px; display:block;"></i>
                    <p>Tu carrito está vacío</p>
                </div>
            </div>
            <div class="bs-drawer-footer">
                <div class="bs-drawer-total">
                    <span>Total</span>
                    <span id="mini-cart-total" style="font-size:1.2rem; color:#1976D2;">$0</span>
                </div>
                <div class="bs-drawer-actions">
                    <a href="{{ route('cart.index') }}" class="btn-view"><i class="fas fa-eye"></i> Ver carrito</a>
                    <a href="{{ route('cart.payment') }}" class="btn-pay"><i class="fas fa-credit-card"></i> Pagar</a>
                </div>
            </div>
        </aside>

        {{-- Toast Container --}}
        <div id="bs-toast-container"></div>

        {{-- Global Confirm Modal --}}
        <div class="bs-modal-overlay" id="bs-confirm-modal">
            <div class="bs-modal">
                <div class="bs-modal-header">
                    <div class="modal-icon danger">⚠️</div>
                    <div>
                        <h3 id="bs-confirm-title">Confirmar acción</h3>
                    </div>
                </div>
                <div class="bs-modal-body">
                    <p id="bs-confirm-message">¿Estás seguro de que deseas realizar esta acción?</p>
                </div>
                <div class="bs-modal-footer">
                    <button id="bs-confirm-cancel" class="bs-btn bs-btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button id="bs-confirm-ok" class="bs-btn bs-btn-danger">
                        <i class="fas fa-check"></i> Confirmar
                    </button>
                </div>
            </div>
        </div>

        {{-- Global Info Modal --}}
        <div class="bs-modal-overlay" id="bs-info-modal">
            <div class="bs-modal">
                <div class="bs-modal-header">
                    <div class="modal-icon info">ℹ️</div>
                    <div>
                        <h3 id="bs-info-title">Información</h3>
                    </div>
                </div>
                <div class="bs-modal-body">
                    <p id="bs-info-message"></p>
                </div>
                <div class="bs-modal-footer">
                    <button id="bs-info-ok" class="bs-btn bs-btn-primary">
                        <i class="fas fa-check"></i> Aceptar
                    </button>
                </div>
            </div>
        </div>

        <script>
        // ============================================
        // BARBERSHOP UI HELPERS
        // ============================================

        // Toast
        function bsToast(message, type = 'info') {
            const container = document.getElementById('bs-toast-container');
            if (!container) return;
            const icons = { success: '✅', error: '❌', warning: '⚠️', info: 'ℹ️' };
            const toast = document.createElement('div');
            toast.className = `bs-toast toast-${type}`;
            toast.innerHTML = `<span>${icons[type] || 'ℹ️'}</span><span>${message}</span>`;
            container.appendChild(toast);
            requestAnimationFrame(() => { requestAnimationFrame(() => { toast.classList.add('show'); }); });
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 350);
            }, 3500);
        }

        // Confirm Modal
        function bsConfirm(message, title, onConfirm) {
            const overlay = document.getElementById('bs-confirm-modal');
            document.getElementById('bs-confirm-title').textContent = title || 'Confirmar acción';
            document.getElementById('bs-confirm-message').textContent = message || '¿Estás seguro?';
            overlay.classList.add('active');
            const cancelBtn = document.getElementById('bs-confirm-cancel');
            const okBtn = document.getElementById('bs-confirm-ok');
            const close = () => overlay.classList.remove('active');
            const newCancel = cancelBtn.cloneNode(true);
            const newOk = okBtn.cloneNode(true);
            cancelBtn.parentNode.replaceChild(newCancel, cancelBtn);
            okBtn.parentNode.replaceChild(newOk, okBtn);
            newCancel.addEventListener('click', close);
            newOk.addEventListener('click', () => { close(); if (onConfirm) onConfirm(); });
            overlay.addEventListener('click', function(e) { if (e.target === overlay) close(); }, { once: true });
        }

        // Info Modal
        function bsInfo(message, title) {
            const overlay = document.getElementById('bs-info-modal');
            document.getElementById('bs-info-title').textContent = title || 'Información';
            document.getElementById('bs-info-message').textContent = message || '';
            overlay.classList.add('active');
            const okBtn = document.getElementById('bs-info-ok');
            const newOk = okBtn.cloneNode(true);
            okBtn.parentNode.replaceChild(newOk, okBtn);
            newOk.addEventListener('click', () => overlay.classList.remove('active'));
            overlay.addEventListener('click', function(e) { if (e.target === overlay) overlay.classList.remove('active'); }, { once: true });
        }

        // Intercept all forms with data-bs-confirm
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form[data-bs-confirm]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const msg = form.dataset.bsConfirm || '¿Estás seguro de que deseas realizar esta acción?';
                    const title = form.dataset.bsConfirmTitle || 'Confirmar acción';
                    bsConfirm(msg, title, () => {
                        form.removeAttribute('data-bs-confirm');
                        form.submit();
                    });
                });
            });

            // Session flash as toast
            @if(session('success'))
                bsToast('{{ addslashes(session('success')) }}', 'success');
            @endif
            @if(session('error'))
                bsToast('{{ addslashes(session('error')) }}', 'error');
            @endif
            @if(session('warning'))
                bsToast('{{ addslashes(session('warning')) }}', 'warning');
            @endif
        });
        </script>

        <script>
        // ============================================
        // BARBERSHOP CART SCRIPTS
        // ============================================
        function formatMoney(value) {
            try { return new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(value); }
            catch(e) { return '$' + Number(value).toLocaleString('es-CO'); }
        }

        function openMiniCart() {
            const overlay = document.getElementById('mini-cart-overlay');
            const drawer  = document.getElementById('mini-cart-drawer');
            if (overlay) overlay.style.display = 'block';
            if (drawer)  { drawer.classList.add('open'); drawer.setAttribute('aria-hidden','false'); }
        }
        function closeMiniCart() {
            const overlay = document.getElementById('mini-cart-overlay');
            const drawer  = document.getElementById('mini-cart-drawer');
            if (overlay) overlay.style.display = 'none';
            if (drawer)  { drawer.classList.remove('open'); drawer.setAttribute('aria-hidden','true'); }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const itemsEl   = document.getElementById('mini-cart-items');
            const totalEl   = document.getElementById('mini-cart-total');
            const countEls  = document.querySelectorAll('.cart-count');

            function setCount(n) { countEls.forEach(e => e.textContent = n); }

            function renderCart(data) {
                if (itemsEl) {
                    const items = data.items || [];
                    if (items.length === 0) {
                        itemsEl.innerHTML = `<div style="text-align:center;padding:40px 0;color:rgba(255,255,255,0.4);">
                            <i class="fas fa-cart-shopping" style="font-size:2rem;margin-bottom:12px;display:block;"></i>
                            <p>Tu carrito está vacío</p></div>`;
                    } else {
                        itemsEl.innerHTML = '';
                        items.forEach(it => {
                            const id = it.id ?? it.producto_id;
                            const maxAttr = it.max ? `max="${it.max}"` : '';
                            const div = document.createElement('div');
                            div.className = 'bs-drawer-item';
                            div.innerHTML = `
                                <div class="bs-drawer-item-info">
                                    <strong>${it.nombre}</strong>
                                    <span>${formatMoney(it.precio)} c/u</span>
                                    <div style="margin-top:8px; display:flex; align-items:center; gap:10px;">
                                        <label style="font-size:0.8rem; color:rgba(255,255,255,0.5);">Cant:</label>
                                        <input type="number" min="1" ${maxAttr} value="${it.qty}" data-id="${id}" class="bs-drawer-qty-input mini-cart-qty">
                                        <button data-id="${id}" class="bs-drawer-item-remove mini-cart-remove"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                <div style="font-weight:700; color:#1976D2; font-size:0.95rem; white-space:nowrap;">${formatMoney(it.subtotal)}</div>`;
                            itemsEl.appendChild(div);
                        });
                    }
                }
                setCount(data.total_items || 0);
                if (totalEl) totalEl.textContent = formatMoney(data.total_price || 0);
            }

            function fetchCart() {
                fetch('{{ route('cart.data') }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(r => r.json()).then(json => renderCart(json))
                    .catch(err => console.error('Error fetching cart', err));
            }

            // Remove
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.mini-cart-remove');
                if (btn) {
                    e.preventDefault();
                    const id = btn.dataset.id;
                    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                    fetch(`{{ url('/cart/item') }}/${id}`, { method:'DELETE', headers:{ 'X-Requested-With':'XMLHttpRequest','X-CSRF-TOKEN':csrf }})
                        .then(r => r.json()).then(json => renderCart(json)).catch(console.error);
                }
            });

            // Quantity change — modal instead of alert
            document.addEventListener('change', function(e) {
                if (e.target && e.target.classList.contains('mini-cart-qty')) {
                    const id  = e.target.dataset.id;
                    let qty   = Math.max(1, parseInt(e.target.value || 1));
                    const max = parseInt(e.target.max || 0);
                    if (max > 0 && qty > max) {
                        qty = max;
                        e.target.value = qty;
                        if (typeof bsInfo === 'function') {
                            bsInfo('La cantidad se ha ajustado al stock disponible: ' + max, 'Stock insuficiente');
                        }
                    }
                    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                    fetch(`{{ url('/cart/item') }}/${id}`, {
                        method:'PATCH',
                        headers:{ 'X-Requested-With':'XMLHttpRequest','Content-Type':'application/json','X-CSRF-TOKEN':csrf },
                        body: JSON.stringify({ qty })
                    }).then(r => r.json()).then(json => {
                        if (json && json.items) renderCart(json);
                        else if (json && json.success === false) bsToast(json.message || 'No se pudo actualizar', 'error');
                    }).catch(console.error);
                }
            });

            // Add to cart (AJAX) - Globally intercept
            document.addEventListener('submit', function(e) {
                const form = e.target;
                if (form.classList.contains('ajax-add-to-cart')) {
                    e.preventDefault();
                    const fd = new FormData(form);
                    fetch(form.action, { method:'POST', body:fd, headers:{ 'X-Requested-With':'XMLHttpRequest' }})
                        .then(r => r.json())
                        .then(json => {
                            if (json.success) {
                                renderCart({ items: json.items, total_items: json.total_items, total_price: json.total_price });
                                openMiniCart();
                                bsToast('Producto agregado al carrito', 'success');
                            } else {
                                bsToast(json.message || 'Error al añadir al carrito', 'error');
                            }
                        }).catch(() => bsToast('Error al añadir al carrito', 'error'));
                }
            });

            // Intercept toggle button logic for any page
            const toggles = document.querySelectorAll('#cart-toggle, .cart-toggle-btn');
            toggles.forEach(t => t.addEventListener('click', function(e) {
                e.preventDefault(); fetchCart(); openMiniCart();
            }));

            fetchCart();
        });
        </script>

        @stack('scripts')
    </body>
</html>
