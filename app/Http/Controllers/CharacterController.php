<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;

class CharacterController extends Controller
{
    public function index(){
        $characters = Character::all();
        
        return view('lists/characters/index', [
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
        $chara->descript = $request->descript;
        $chara->save();
        
        return redirect()->route('charas.index');
    }
    
    public function detail(Character $chara){
        $chara->findOrFail($chara->id);
        
        return view('lists/characters/detail', [
            'chara_id' => $chara->id,
            'chara_name' => $chara->name,
            'chara_explain' => $chara->explain,
            'chara_descript' => $chara->descript,
        ]);
    }
    
    public function editForm(Character $chara){
        $chara->findOrFail($chara->id);
        
        return view('lists/characters/edit', [
            'chara_id' => $chara->id,
            'chara_name' => $chara->name,
            'chara_explain' => $chara->explain,
            'chara_descript' => $chara->descript,
        ]);
    }
    
    public function edit(Character $chara, Request $request){
        $chara->findOrFail($chara->id);
        
        $chara->name = $request->name;
        $chara->explain = $request->explain;
        $chara->save();
        
        return redirect()->route('charas.index');
    }
    
    public function deleteForm(Character $chara){
        $chara->findOrFail($chara->id);
        
        return view('lists/characters/delete', [
            'chara_id' => $chara->id,
            'chara_name' => $chara->name,
            'chara_explain' => $chara->explain,
            'chara_descript' => $chara->descript,
        ]);
    }
    
    public function delete(Character $chara, Request $request){
        $chara->findOrFail($chara->id);
        
        $chara->delete();
        
        return redirect()->route('charas.index');
    }
}
