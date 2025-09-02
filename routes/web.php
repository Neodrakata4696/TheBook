<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Models\Character;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\StoryController;
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

//キャラクター
Route::get('/charas', [CharacterController::class, 'index'])->name('charas.index');
Route::get('/charas/{chara}', [CharacterController::class, 'detail'])->name('charas.detail')->where('chara', '[0-9]+');

//ストーリー
Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('/stories/{story}', [StoryController::class, 'storyPage'])->name('stories.story')->where('story', '[0-9]+');

//ギャラリー
Route::get('/gallery', [ImageController::class, 'index'])->name('img.gallery');
Route::get('/gallery/{image}', [ImageController::class, 'detail'])->name('images.detail')->where('image', '[0-9]+');

//ユーザー
Route::get('/users/{user}', [UserController::class, 'userIndex'])->name('users.index');
Route::get('/users/{user}/charas', [UserController::class, 'userCharacters'])->name('users.charas');
Route::get('/users/{user}/images', [UserController::class, 'userImages'])->name('users.images');

Route::group(['middleware' => 'auth'], function() {
    //キャラクター作成
    Route::get('/charas/create', [CharacterController::class, 'createForm'])->name('charas.create');
    Route::post('/charas/create', [CharacterController::class, 'create']);
    Route::get('/charas/create/confirm', [CharacterController::class, 'createConfirm'])->name('charas.createConfirm');
    Route::post('/charas/create/confirm', [CharacterController::class, 'createSend']);
    
    //ストーリー作成
    Route::get('/stories/create', [StoryController::class, 'createForm'])->name('stories.create');
    Route::post('/stories/create', [StoryController::class, 'create']);
    Route::get('/stories/create/confirm', [StoryController::class, 'createConfirm'])->name('stories.createConfirm');
    Route::post('/stories/create/confirm', [StoryController::class, 'createSend']);
    
    //画像投稿
    Route::post('/gallery', [ImageController::class, 'upload'])->name('img.upload');
    
    //ユーザーフォロー
    Route::get('/users/{user}/followList', [FollowUserController::class, 'followIndex'])->name('users.followIndex');
    Route::get('/users/{user}/followerList', [FollowUserController::class, 'followerIndex'])->name('users.followerIndex');
    Route::post('/users/{user}/follow', [FollowUserController::class, 'follow'])->name('users.follow');
    
    //ブックマーク
    Route::get('/users/{user}/bookmark', [UserController::class, 'userBookmarkPage'])->name('users.bookmark');
    Route::post('/charas/{chara}', [CharacterController::class, 'bookmark'])->name('charas.bookmark');
    
    Route::group(['middleware' => 'can:view,chara'], function() {
        //キャラクター編集
        Route::get('/charas/{chara}/edit', [CharacterController::class, 'editForm'])->name('charas.edit');
        Route::post('/charas/{chara}/edit', [CharacterController::class, 'edit']);
        Route::get('/charas/{chara}/edit/confirm', [CharacterController::class, 'editConfirm'])->name('charas.editConfirm');
        Route::post('/charas/{chara}/edit/confirm', [CharacterController::class, 'editSend']);
        
        //キャラクター削除
        Route::get('/charas/{chara}/delete', [CharacterController::class, 'deleteForm'])->name('charas.delete');
        Route::post('/charas/{chara}/delete', [CharacterController::class, 'delete']);
    });
    
    Route::group(['middleware' => 'can:view,story'], function() {
        //ストーリー編集
        Route::get('/stories/{story}/edit', [StoryController::class, 'editForm'])->name('stories.edit');
        Route::post('/stories/{story}/edit', [StoryController::class, 'edit']);
        Route::get('/stories/{story}/edit/confirm', [StoryController::class, 'editConfirm'])->name('stories.editConfirm');
        Route::post('/stories/{story}/edit/confirm', [StoryController::class, 'editSend']);
        
        //ストーリー削除
        Route::get('/stories/{story}/delete', [StoryController::class, 'deleteForm'])->name('stories.delete');
        Route::post('/stories/{story}/delete', [StoryController::class, 'delete']);
    });
});

Route::get('/print', [CharacterController::class, 'printList'])->name('printList');
Route::get('/users/{user}/print', [CharacterController::class, 'printListByUser'])->name('printListByUser');

//Route::get('/charaList/{chara}', [CharacterController::class, 'detail'])->name('charas.detail');

require __DIR__.'/auth.php';
