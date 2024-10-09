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
