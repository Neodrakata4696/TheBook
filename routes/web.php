<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Models\Character;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\FollowUserController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('toppage');

Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//以下、TheBookのページ

Route::get('/charas', [CharacterController::class, 'index'])->name('charas.index');
Route::get('/charas/{chara}', [CharacterController::class, 'detail'])->name('charas.detail')->where('chara', '[0-9]+');

Route::get('/users/{user}', [UserController::class, 'userIndex'])->name('users.index');
Route::get('/gallery', [ImageController::class, 'index'])->name('img.gallery');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/charas/create', [CharacterController::class, 'createForm'])->name('charas.create');
    Route::post('/charas/create', [CharacterController::class, 'create']);
    Route::get('/charas/create/confirm', [CharacterController::class, 'createConfirm'])->name('charas.createConfirm');
    Route::post('/charas/create/confirm', [CharacterController::class, 'createSend']);
    
    Route::get('/users/{user}/followList', [FollowUserController::class, 'followIndex'])->name('users.followIndex');
    Route::get('/users/{user}/followerList', [FollowUserController::class, 'followerIndex'])->name('users.followerIndex');
    
    Route::post('/users/{user}/follow', [FollowUserController::class, 'follow'])->name('users.follow');
    
    Route::group(['middleware' => 'can:view,chara'], function() {
        Route::get('/charas/{chara}/edit', [CharacterController::class, 'editForm'])->name('charas.edit');
        Route::post('/charas/{chara}/edit', [CharacterController::class, 'edit']);
        Route::get('/charas/{chara}/edit/confirm', [CharacterController::class, 'editConfirm'])->name('charas.editConfirm');
        Route::post('/charas/{chara}/edit/confirm', [CharacterController::class, 'editSend']);
        
        Route::get('/charas/{chara}/delete', [CharacterController::class, 'deleteForm'])->name('charas.delete');
        Route::post('/charas/{chara}/delete', [CharacterController::class, 'delete']);
    });
    
    Route::post('/gallery', [ImageController::class, 'upload'])->name('img.upload');
});

Route::get('/list/chara', [CharacterController::class, 'printList'])->name('printList');
Route::get('/users/{user}/list/chara', [CharacterController::class, 'printListByUser'])->name('printListByUser');

//Route::get('/charaList/{chara}', [CharacterController::class, 'detail'])->name('charas.detail');

require __DIR__.'/auth.php';
