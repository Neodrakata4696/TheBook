<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;

Route::get('/', function () {
    //return view('welcome');
    return view('Hello');
});

Route::get('/charaList', [CharacterController::class, "index"])->name('charas.index');

Route::get('/charaList/create', [CharacterController::class, "createForm"])->name('charas.create');
Route::post('/charaList/create', [CharacterController::class, "create"]);

Route::get('/charaList/{chara}', [CharacterController::class, "detail"])->name('charas.detail');

Route::get('/charaList/{chara}/edit', [CharacterController::class, "editForm"])->name('charas.edit');
Route::post('/charaList/{chara}/edit', [CharacterController::class, "edit"]);

Route::get('/charaList/{chara}/delete', [CharacterController::class, "deleteForm"])->name('charas.delete');
Route::post('/charaList/{chara}/delete', [CharacterController::class, "delete"]);

?>