<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AdminProductoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Página de inicio
Route::get('/', function () {
    return view('home', ['hideNav' => true]);
});

// Catálogo público
Route::get('/productos', [ProductoController::class, 'public'])->name('productos.public');
Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');

// Rutas para usuarios autenticados (user y admin, controlo el rol en el controlador)
Route::middleware(['auth'])->group(function () {
    // Catálogo para usuario registrado
    Route::get('/user/productos', [ProductoController::class, 'user'])->name('productos.user');
    Route::post('/productos/{producto}/comprar', [ProductoController::class, 'comprar'])->name('productos.comprar');

    // Panel de administración y CRUD de productos
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');
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
Route::middleware(['auth'])->group(function () {
    
});

require __DIR__ . '/auth.php'; 
