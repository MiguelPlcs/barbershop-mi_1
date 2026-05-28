<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Login;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Producto;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Merge guest session cart into user's DB cart on login
        Event::listen(Login::class, function ($event) {
            $user = $event->user;
            $sessionCart = session('cart', []);
            if (empty($sessionCart)) {
                return;
            }

            $cart = Cart::firstOrCreate(['user_id' => $user->id]);
            foreach ($sessionCart as $entry) {
                $productoId = $entry['producto_id'] ?? null;
                if (!$productoId) continue;
                $producto = Producto::find($productoId);
                $qty = max(1, (int)($entry['qty'] ?? 1));
                if ($producto && isset($producto->stock)) {
                    $qty = min($qty, (int)$producto->stock);
                }

                $existing = CartItem::where('cart_id', $cart->id)->where('producto_id', $productoId)->first();
                if ($existing) {
                    $existing->qty = isset($producto->stock) ? min($existing->qty + $qty, (int)$producto->stock) : ($existing->qty + $qty);
                    $existing->save();
                } else {
                    CartItem::create([
                        'cart_id' => $cart->id,
                        'producto_id' => $productoId,
                        'nombre' => $entry['nombre'] ?? ($producto->nombre ?? 'Producto'),
                        'precio' => $entry['precio'] ?? ($producto->precio ?? 0),
                        'qty' => $qty,
                    ]);
                }
            }

            session()->forget('cart');
        });
    }
}
