<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Cart;
use App\Models\CartItem;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // <-- agrega esta línea
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Si el usuario tenía un carrito en sesión (invitado), migrarlo al carrito persistente
        $sessionCart = session('cart', []);
        if (!empty($sessionCart)) {
            $cartModel = Cart::firstOrCreate(['user_id' => $user->id]);
            foreach ($sessionCart as $key => $item) {
                CartItem::create([
                    'cart_id' => $cartModel->id,
                    'producto_id' => $item['producto_id'] ?? $key,
                    'nombre' => $item['nombre'] ?? '',
                    'precio' => $item['precio'] ?? 0,
                    'qty' => $item['qty'] ?? 1,
                ]);
            }
            // Eliminar carrito de sesión una vez migrado
            session()->forget('cart');
        }

        // Redirigir directamente al formulario de pago para que el usuario ingrese datos y culmine la compra
        return redirect()->route('cart.payment');
    }
}
