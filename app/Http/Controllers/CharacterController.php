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
use Illuminate\Support\Facades\Storage;

class CharacterController extends Controller
{
    private $chara_input = ["name", "explain", "descript"];
    
    public function index(Request $request){
        $list = Character::query();
        
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {
            $list->where('name', 'LIKE', "%{$keyword}%")->orWhere('explain', 'LIKE', "%{$keyword}%")->get();
        }
        
        $characters = $list->latest()->paginate(15);
        
        return view('characters.index', [
            'characters' => $characters,
        ]);
    }
    
    public function detail(Character $chara){
        $chara->findOrFail($chara->id);
        
        return view('characters.detail', [
            'chara' => $chara,
        ]);
    }
    
    public function createForm(){
        $gallery = Image::orderBy('id', 'DESC')->paginate(15);
        return view('characters.create', [
            'images' => $gallery,
        ]);
    }
    
    public function create(CreateCharacter $request){
        $request->session()->forget(["chara_session", "image_session", "image_id_session", "image_name_session", "image_original_session"]);
        $chara_session = $request->only($this->chara_input);
        
        $validated = $request->validate([
            'uploaded_image' => 'mimetypes:image/png, image/jpeg',
        ]);
        
        if ($request->file('uploaded_image') !== null){
            $original_name = $request->file('uploaded_image')->getClientOriginalName();
            $image_name = ImageController::getImageName($request);
            $request->file('uploaded_image')->storeAs('/img_store', $image_name, 'public');
            $image = 'storage/img_store/'. $image_name;
            $request->session()->put("image_session", $image);
            $request->session()->put("image_name_session", $image_name);
            $request->session()->put("image_original_session", $original_name);
        }
        else if ($request->selected_image !== null){
            $getid = $request->selected_image;
            $request->session()->put("image_id_session", $getid);
        }
        $request->session()->put("chara_session", $chara_session);
        
        $request->session()->put('token', csrf_token());
        return redirect()->route('charas.createConfirm');
    }
    
    public function createConfirm(Request $request){
        if (!$request->session()->exists('token')){
            return redirect()->route('charas.create');
        }
        
        $chara_session = $request->session()->get("chara_session");
        if ($request->session()->get("image_session") !== null){
            $image_session = $request->session()->get("image_session");
        }
        else if ($request->session()->get("image_id_session") !== null){
            $image_session = Image::find($request->session()->get("image_id_session"))->path;
        }
        else{
            $image_session = null;
        }
        
        return view('characters.createConfirm', [
            "chara" => $chara_session,
            "image_path" => $image_session,
        ]);
    }
    
    public function createSend(Request $request){
        $chara_session = $request->session()->get("chara_session");
        $image_session = $request->session()->get("image_session");
        $image_id_session = $request->session()->get("image_id_session");
        $image_name = $request->session()->get("image_name_session");
        $original_name = $request->session()->get("image_original_session");
        
        $chara = new Character();
        
        if ($image_session !== null){
            $image = new Image();
            $new_image_path = ImageController::getImagePath() . '/' . $image_name;
            Storage::disk('public')->move('img_store/' . $image_name, $new_image_path);
            $info_name = pathinfo($original_name, PATHINFO_FILENAME);
            $image->name = $info_name;
            $image->path = 'storage/' . $new_image_path;
            Auth::user()->images()->save($image);
            $chara->image_id = $image->id;
            $request->session()->forget("image_session");
            $request->session()->forget("image_name_session");
            $request->session()->forget("image_original_session");
        }
        else if ($image_id_session !== null){
            $chara->image_id = $image_id_session;
            $request->session()->forget("image_id_session");
        }
        
        $chara->name = $chara_session['name'];
        $chara->explain = $chara_session['explain'];
        $chara->descript = $chara_session['descript'];
        Auth::user()->characters()->save($chara);
        $request->session()->forget(["chara_session", "token"]);
        return redirect()->route('charas.detail', [
            "chara" => $chara->id,
        ])->with('message', '作成完了しました');
    }
    
    public function editForm(Character $chara){
        $user = Auth::user();
        $chara = $user->characters()->findOrFail($chara->id);
        $gallery = Image::orderBy('id', 'DESC')->paginate(15);
        
        return view('characters.edit', [
            'chara' => $chara,
            'images' => $gallery,
        ]);
    }
    
    public function edit(Character $chara, CreateCharacter $request){
        $user = Auth::user();
        $chara = $user->characters()->findOrFail($chara->id);
        
        $request->session()->forget(["chara_session", "image_session", "image_id_session", "image_name_session", "image_original_session"]);
        $chara_session = $request->only($this->chara_input);
        
        $validated = $request->validate([
            'uploaded_image' => 'mimetypes:image/png, image/jpeg',
        ]);
        
        if ($request->file('uploaded_image') !== null){
            $original_name = $request->file('uploaded_image')->getClientOriginalName();
            $image_name = ImageController::getImageName($request);
            $request->file('uploaded_image')->storeAs('/img_store', $image_name, 'public');
            $image = 'storage/img_store/'. $image_name;
            $request->session()->put("image_session", $image);
            $request->session()->put("image_name_session", $image_name);
            $request->session()->put("image_original_session", $original_name);
        }
        else if ($request->selected_image !== null){
            $getid = $request->selected_image;
            $request->session()->put("image_id_session", $getid);
        }
        $request->session()->put("chara_session", $chara_session);
        
        $request->session()->put('token', csrf_token());
        $request->session()->put('chara_id_session', $chara->id);
        return redirect()->route('charas.editConfirm', [
            "chara" => $chara,
        ]);
    }
    
    public function editConfirm(Character $chara, Request $request){
        $user = Auth::user();
        $chara = $user->characters()->findOrFail($chara->id);
        if (!$request->session()->exists('token')){
            return redirect()->route('charas.edit', [
                "chara" => $chara,
            ]);
        }
        else if ($request->session()->get('chara_id_session') !== $chara->id){
            return redirect()->route('charas.edit', [
                "chara" => $chara,
            ]);
        }
        
        $chara_session = $request->session()->get("chara_session");
        if ($request->session()->get("image_session") !== null){
            $image_session = $request->session()->get("image_session");
        }
        else if ($request->session()->get("image_id_session") !== null){
            $image_session = Image::find($request->session()->get("image_id_session"))->path;
        }
        else{
            $image_session = null;
        }
        
        if (!$chara_session){
            return redirect()->route('charas.edit', ["chara" => $chara]);
        }
        
        return view('characters.editConfirm', [
            "chara_id" => $chara,
            "chara" => $chara_session,
            "image_path" => $image_session,
        ]);
    }
    
    public function editSend(Character $chara, Request $request){
        $user = Auth::user();
        $chara = $user->characters()->findOrFail($chara->id);
        
        $chara_session = $request->session()->get("chara_session");
        $image_session = $request->session()->get("image_session");
        $image_id_session = $request->session()->get("image_id_session");
        $image_name = $request->session()->get("image_name_session");
        $original_name = $request->session()->get("image_original_session");
        
        if ($image_session !== null){
            $image = new Image();
            $new_image_path = ImageController::getImagePath() . '/' . $image_name;
            Storage::disk('public')->move('img_store/' . $image_name, $new_image_path);
            $info_name = pathinfo($original_name, PATHINFO_FILENAME);
            $image->name = $info_name;
            $image->path = 'storage/' . $new_image_path;
            Auth::user()->images()->save($image);
            $chara->image_id = $image->id;
            $request->session()->forget("image_session");
            $request->session()->forget("image_name_session");
            $request->session()->forget("image_original_session");
        }
        else if ($image_id_session !== null){
            $chara->image_id = $image_id_session;
            $request->session()->forget("image_id_session");
        }
        else{
            $chara->image_id = null;
        }
        
        $chara->name = $chara_session['name'];
        $chara->explain = $chara_session['explain'];
        $chara->descript = $chara_session['descript'];
        $chara->save();
        $request->session()->forget(["chara_session", "token", "chara_id_session"]);
        return redirect()->route('charas.detail', [
            "chara" => $chara,
        ])->with('message', '更新完了しました');
    }
    
    public function deleteForm(Character $chara){
        $user = Auth::user();
        $chara = $user->characters()->findOrFail($chara->id);
        
        return view('characters.delete', [
            'chara' => $chara,
        ]);
    }
    
    public function delete(Character $chara){
        $user = Auth::user();
        $chara = $user->characters()->findOrFail($chara->id);
        
        $chara->delete();
        
        return redirect()->route('charas.index');
    }
    
    public function printList(){
        $charas = Character::all();
        return view('charactersList', [
            'charas' => $charas,
        ]);
    }
    
    public function printListByUser(User $user){
        $user = $user->findOrFail($user->id);
        $charas = Character::where('user_id', [$user->id])->get();
        return view('charactersList', [
            'user' => $user,
            'charas' => $charas,
        ]);
    }
}
