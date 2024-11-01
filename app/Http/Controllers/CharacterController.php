<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Character;
use App\Http\Requests\CreateCharacter;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    public function index(Request $request){
        $user = $request->user();
        $list = Character::query();
        
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {
            $list->where('name', 'LIKE', "%{$keyword}%")->get();
        }
        
        $characters = $list->get();
        
        return view('lists.characters.index', [
            'characters' => $characters,
        ]);
    }
    
    public function prindex(User $user, Request $request){
        $user->findOrFail($user->id);
        $characters = $user->characters()->get();
        
        return view('lists.characters.prindex', [
            'characters' => $characters,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }
    
    public function detail(Character $chara){
        $chara->findOrFail($chara->id);
        
        return view('lists.characters.detail', [
            'chara' => $chara,
            'chara_id' => $chara->id,
            'chara_name' => $chara->name,
            'chara_explain' => $chara->explain,
            'chara_descript' => $chara->descript,
            'chara_user' => $chara->user->name,
        ]);
    }
    
    public function createForm(){
        return view('lists.characters.create');
    }
    
    public function create(CreateCharacter $request){
        $chara = new Character();
        $chara->name = $request->name;
        $chara->explain = $request->explain;
        $chara->descript = $request->descript;
        Auth::user()->characters()->save($chara);
        
        return redirect()->route('charas.index');
    }
        
    public function editForm(Character $chara){
        $user = Auth::user();
        $chara = $user->characters()->findOrFail($chara->id);
        
        return view('lists.characters.edit', [
            'chara_id' => $chara->id,
            'chara_name' => $chara->name,
            'chara_explain' => $chara->explain,
            'chara_descript' => $chara->descript,
        ]);
    }
    
    public function edit(Character $chara, CreateCharacter $request){
        $user = Auth::user();
        $chara = $user->characters()->findOrFail($chara->id);
        
        $chara->name = $request->name;
        $chara->explain = $request->explain;
        $chara->descript = $request->descript;
        $chara->save();
        
        return redirect()->route('charas.index');
    }
    
    public function deleteForm(Character $chara){
        $user = Auth::user();
        $chara = $user->characters()->findOrFail($chara->id);
        
        return view('lists.characters.delete', [
            'chara_id' => $chara->id,
            'chara_name' => $chara->name,
            'chara_explain' => $chara->explain,
            'chara_descript' => $chara->descript,
        ]);
    }
    
    public function delete(Character $chara){
        $user = Auth::user();
        $chara = $user->characters()->findOrFail($chara->id);
        
        $chara->delete();
        
        return redirect()->route('charas.index');
    }
}
