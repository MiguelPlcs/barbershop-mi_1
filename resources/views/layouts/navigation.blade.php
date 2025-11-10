<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center">
            <div class="flex">
                {{-- Logo y enlace 'Dashboard' eliminados por petición del cliente --}}
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white dark:text-white dark:bg-gray-800 hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                             this.closest('form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    {{-- Mensaje para invitados eliminado por petición del cliente --}}
                @endauth
                {{-- Carrito se renderiza en la cabecera principal de la página (home) para posicionarlo junto a 'Iniciar sesión' --}}
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- Enlaces 'Dashboard' eliminados del menú responsivo --}}
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-white">
                    @auth
                        {{ Auth::user()->name }}
                    @else
                        Invitado
                    @endauth
                </div>
                <div class="font-medium text-sm text-gray-500">
                    @auth
                        {{ Auth::user()->email }}
                    @endauth
                </div>
            </div>

            <div class="mt-3 space-y-1">
                @auth
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                     this.closest('form').submit();">
                            {{ __('Cerrar sesión') }}
                        </x-responsive-nav-link>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    // Mini-cart global handlers: fetch cart data, toggle, update/delete items
    document.addEventListener('DOMContentLoaded', function () {
        function formatMoney(value) {
            try {
                return new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(value);
            } catch (e) {
                return '$' + Number(value).toLocaleString('es-CO');
            }
        }

        const cartToggle = document.getElementById('cart-toggle');
        const miniCart = document.getElementById('mini-cart');
        const itemsEl = document.getElementById('mini-cart-items');
        const totalEl = document.getElementById('mini-cart-total');
        const countEls = document.querySelectorAll('.cart-count');

        function setCount(n) { countEls.forEach(e => e.textContent = n); }

        function renderCart(data) {
            itemsEl.innerHTML = '';
                (data.items || []).forEach(it => {
                const id = it.id ?? it.producto_id;
                const row = document.createElement('div');
                row.style.display = 'flex'; row.style.justifyContent = 'space-between'; row.style.marginBottom = '8px';
                const maxAttr = it.max ? `max="${it.max}"` : '';
                row.innerHTML = `
                    <div style="flex:1">
                        <div style="display:flex;justify-content:space-between;align-items:center">
                            <strong>${it.nombre}</strong>
                            <a href="#" data-id="${id}" class="mini-cart-remove text-red-600" style="margin-left:8px">Eliminar</a>
                        </div>
                        <div style="margin-top:4px">Precio: ${formatMoney(it.precio)}</div>
                        <div style="margin-top:6px">Cantidad: <input type="number" min="1" ${maxAttr} value="${it.qty}" data-id="${id}" class="mini-cart-qty" style="width:64px;padding:4px;border:1px solid #ddd;border-radius:4px" /></div>
                    </div>
                    <div style="margin-left:8px;text-align:right">${formatMoney(it.subtotal)}</div>
                `;
                itemsEl.appendChild(row);
            });
            setCount(data.total_items || 0);
            totalEl.textContent = formatMoney(data.total_price || 0);
        }

        function fetchCart() {
            fetch('{{ route('cart.data') }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(r => r.json())
                .then(json => renderCart(json))
                .catch(err => console.error('Error fetching cart', err));
        }

        // Toggle
        if (cartToggle) {
            cartToggle.addEventListener('click', function (e) {
                e.preventDefault();
                if (miniCart.style.display === 'block') { miniCart.style.display = 'none'; }
                else { fetchCart(); miniCart.style.display = 'block'; }
            });
        }

        // Delegate remove clicks
        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('mini-cart-remove')) {
                e.preventDefault();
                const id = e.target.dataset.id;
                fetch(`/cart/item/${id}`, { method: 'DELETE', headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') } })
                    .then(r => r.json()).then(json => renderCart(json)).catch(err => console.error(err));
            }
        });

        // Delegate quantity change
        document.addEventListener('change', function (e) {
            if (e.target && e.target.classList.contains('mini-cart-qty')) {
                const id = e.target.dataset.id;
                let qty = Math.max(1, parseInt(e.target.value || 1));
                const max = parseInt(e.target.max || 0);
                if (max > 0 && qty > max) {
                    qty = max;
                    e.target.value = qty;
                    // Inform the user that the quantity was adjusted to available stock
                    alert('La cantidad se ha ajustado al stock disponible: ' + max);
                }
                fetch(`/cart/item/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ qty: qty })
                }).then(r => r.json()).then(json => {
                    if (json && json.items) renderCart(json);
                    else if (json && json.success === false) alert(json.message || 'No se pudo actualizar');
                }).catch(err => console.error('Error updating qty', err));
            }
        });

        // Update quantity from mini-cart (future if we add controls)

        // Intercept add-to-cart forms globally
        document.addEventListener('submit', function (e) {
            const form = e.target;
            if (form.classList.contains('ajax-add-to-cart')) {
                e.preventDefault();
                const fd = new FormData(form);
                fetch(form.action, { method: 'POST', body: fd, headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(r => r.json())
                    .then(json => {
                        if (json.success) {
                            renderCart({ items: json.items, total_items: json.total_items, total_price: json.total_price });
                            miniCart.style.display = 'block';
                            setTimeout(() => { miniCart.style.display = 'none'; }, 3500);
                        } else {
                            alert(json.message || 'Error al añadir al carrito');
                        }
                    }).catch(err => console.error('Add to cart error', err));
            }
        });

        // Initial fetch to set count
        fetchCart();
    });
</script>
