<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => 'auth'], function() {
    //キャラクター
    Route::get('/charaList', [CharacterController::class, 'index'])->name('charas.index');

    Route::get('/charaList/create', [CharacterController::class, 'createForm'])->name('charas.create');
    Route::post('/charaList/create', [CharacterController::class, 'create']);

    Route::get('/charaList/{chara}', [CharacterController::class, 'detail'])->name('charas.detail');

    Route::get('/charaList/{chara}/edit', [CharacterController::class, 'editForm'])->name('charas.edit');
    Route::post('/charaList/{chara}/edit', [CharacterController::class, 'edit']);

    Route::get('/charaList/{chara}/delete', [CharacterController::class, 'deleteForm'])->name('charas.delete');
    Route::post('/charaList/{chara}/delete', [CharacterController::class, 'delete']);
});

require __DIR__.'/auth.php';
