<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;

Route::get('/', function () {
    $users = User::all(); // Fetch all users
    return view('main', compact('users'));
});

Route::get('/timezone-test', function () {
    return Date::now()->format('Y-m-d H:i:s');
});

Route::get('/products', [ProductController::class, 'index']);
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'index']);

Route::post('/login-as', function (Request $request) {
    $user = User::find($request->user_id);
    if ($user) {
        Auth::login($user); 
        return redirect('/')->with('success', 'Logged in as ' . $user->name);
    }
    return redirect('/')->with('error', 'User not found');
})->name('login-as');