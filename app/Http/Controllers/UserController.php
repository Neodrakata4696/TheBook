<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;

class UserController extends Controller
{
    public function dashboard(){
        $characters = Character::latest()->paginate(5);
        return view('dashboard', [
            'characters' => $characters,
        ]);
    }
}
