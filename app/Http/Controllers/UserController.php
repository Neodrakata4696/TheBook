<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Character;
use App\Models\Image;
use App\Models\Bookmark;

class UserController extends Controller
{
    public function dashboard(){
        $characters = Character::latest()->paginate(5);
        return view('dashboard', [
            'characters' => $characters,
        ]);
    }
    
    public function userIndex(User $user, Request $request){
        $user->findOrFail($user->id);
        $characters = $user->characters()->latest()->paginate(15);
        $images = $user->images()->latest()->paginate(15);
        $bookmarks = $user->bookmarks()->latest()->paginate(5);
        
        return view('users.index', [
            'characters' => $characters,
            'images' => $images,
            'bookmarks' => $bookmarks,
            'user' => $user,
        ]);
    }
    
    public function userCharacters(User $user){
        $user->findOrFail($user->id);
        $characters = $user->characters()->latest()->paginate(15);
        
        return view('users.chara', [
            'characters' => $characters,
            'user' => $user,
        ]);
    }
    
    public function userImages(User $user){
        $user->findOrFail($user->id);
        $images = $user->images()->latest()->paginate(15);
        
        return view('users.image', [
            'images' => $images,
            'user' => $user,
        ]);
    }
    
    public function userBookmarkPage(User $user){
        $user->findOrFail($user->id);
        $bookmarks = Bookmark::where('user_id', $user->id)->latest()->paginate(15);
        
        return view('users.bookmark', [
            'user' => $user,
            'bookmarks' => $bookmarks,
        ]);
    }
}
