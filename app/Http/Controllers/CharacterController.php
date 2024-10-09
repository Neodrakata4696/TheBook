<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;

class CharacterController extends Controller
{
    public function index(){
        $characters = Character::all();
        
        return view('lists/character', [
            'characters' => $characters,
        ]);
    }
    
    public function createForm(){
        return view('lists/characters/create');
    }
    
    public function create(Request $request){
        $chara = new Character();
        $chara->name = $request->name;
        $chara->explain = $request->explain;
        $chara->save();
        
        return redirect()->route('charas.index');
    }
}
