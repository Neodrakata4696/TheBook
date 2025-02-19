<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Character;
use App\Models\FollowUser;
use App\Models\Image;
use App\Http\Controllers\ImageController;
use App\Http\Requests\CreateCharacter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CharacterController extends Controller
{
    public function index(Request $request){
        $list = Character::query();
        
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {
            $list->where('name', 'LIKE', "%{$keyword}%")->orWhere('explain', 'LIKE', "%{$keyword}%")->get();
        }
        
        $characters = $list->latest()->paginate(15);
        
        return view('lists.characters.index', [
            'characters' => $characters,
        ]);
    }
    
    public function detail(Character $chara){
        $chara->findOrFail($chara->id);
        
        return view('lists.characters.detail', [
            'chara' => $chara,
            'chara_id' => $chara->id,
            'chara_name' => $chara->name,
            'chara_image' => $chara->image_path,
            'chara_explain' => $chara->explain,
            'chara_descript' => $chara->descript,
            'chara_user' => $chara->user->name,
        ]);
    }
    
    public function createForm(){
        $gallery = Image::latest()->get();
        return view('lists.characters.create', [
            'images' => $gallery,
        ]);
    }
    
    public function create(CreateCharacter $request){
        $chara = new Character();
        $chara->name = $request->name;
        $getpath = null;
        if ($request->file('upload-image') !== null){
            $original_name = $request->file('upload-image')->getClientOriginalName();
            $image_name = ImageController::getImageName($request);
            $request->file('upload-image')->storeAs(ImageController::getImagePath(), $image_name, 'public');

            $image = new Image();
            $image->name = $original_name;
            $image->path = 'storage/'. ImageController::getImagePath() . '/' . $image_name;
            Auth::user()->images()->save($image);
            $getpath = $image->path;
        }
        else if ($request->image !== null){
            $getpath = $request->image;
        }
        $chara->image_path = $getpath;
        $chara->explain = $request->explain;
        $chara->descript = $request->descript;
        Auth::user()->characters()->save($chara);
        
        return redirect()->route('charas.index');
    }
    
    public function editForm(Character $chara){
        $user = Auth::user();
        $chara = $user->characters()->findOrFail($chara->id);
        $gallery = Image::latest()->get();
        
        return view('lists.characters.edit', [
            'chara_id' => $chara->id,
            'chara_name' => $chara->name,
            'chara_image' => $chara->image_path,
            'chara_explain' => $chara->explain,
            'chara_descript' => $chara->descript,
            'images' => $gallery,
        ]);
    }
    
    public function edit(Character $chara, CreateCharacter $request){
        $user = Auth::user();
        $chara = $user->characters()->findOrFail($chara->id);
        
        $chara->name = $request->name;
        $getpath = null;
        if ($request->file('upload-image') !== null){
            $original_name = $request->file('upload-image')->getClientOriginalName();
            $image_name = ImageController::getImageName($request);
            $request->file('upload-image')->storeAs(ImageController::getImagePath(), $image_name, 'public');

            $image = new Image();
            $image->name = $original_name;
            $image->path = 'storage/'. ImageController::getImagePath() . '/' . $image_name;
            Auth::user()->images()->save($image);
            $getpath = $image->path;
        }
        else if ($request->image !== null){
            $getpath = $request->image;
        }
        $chara->image_path = $getpath;
        $chara->explain = $request->explain;
        $chara->descript = $request->descript;
        $chara->save();
        
        return redirect()->route('charas.detail', ['chara' => $chara]);
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
