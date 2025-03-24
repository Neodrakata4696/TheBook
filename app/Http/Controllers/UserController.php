<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Character;

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
        
        return view('user_index', [
            'characters' => $characters,
            'user' => $user,
        ]);
    }
}
