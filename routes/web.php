<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AdminProductoController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Página de inicio
Route::get('/', function () {
    // Redirigir admin al dashboard
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Mostrar productos en la página principal (paginados)
    $productos = \App\Models\Producto::paginate(9);
    // Obtener categorías únicas desde los productos
    $categorias = \App\Models\Producto::pluck('categoria')->filter()->unique()->values();
    return view('home', compact('productos', 'categorias'));
});

// Catálogo público
Route::get('/productos', [ProductoController::class, 'public'])->name('productos.public');
Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');

// Rutas para usuarios autenticados (user y admin, controlo el rol en el controlador)
// Rutas públicas relacionadas con el carrito
Route::post('/cart/add/{producto}', [ProductoController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [ProductoController::class, 'cart'])->name('cart.index');

// Endpoints para gestión del carrito (AJAX)
Route::get('/cart/data', [\App\Http\Controllers\CartController::class, 'data'])->name('cart.data');
Route::patch('/cart/item/{id}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/item/{id}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');

Route::middleware(['auth'])->group(function () {
    // Catálogo para usuario registrado
    Route::get('/user/productos', [ProductoController::class, 'user'])->name('productos.user');
    Route::post('/productos/{producto}/comprar', [ProductoController::class, 'comprar'])->name('productos.comprar');

    // Checkout del carrito (solo para usuarios autenticados)
    Route::post('/cart/checkout', [ProductoController::class, 'checkout'])->name('cart.checkout');

    // Panel de administración y CRUD de productos
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('productos', AdminProductoController::class);
    });

    // Perfil
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Redirección al dashboard según el rol
Route::get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role === 'user') {
            return redirect()->route('productos.user');
        }
    }
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

// rutas de usuario
Route::middleware(['auth'])->group(function () {});

require __DIR__ . '/auth.php';
