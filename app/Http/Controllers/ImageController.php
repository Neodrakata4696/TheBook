<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use App\Models\User;

class ImageController extends Controller
{
    public static function getImagePath(){
        return 'img/'. Auth::id();
    }
    
    public function index(){
        $gallery = Image::latest()->get();
        return view('gallery.index', [
            'images' => $gallery,
        ]);
    }
    
    public function upload(Request $request){
        $file_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs($this->getImagePath(), $file_name, 'public');
        
        $image = new Image();
        $image->name = $file_name;
        $image->path = 'storage/'. $this->getImagePath() . '/' . $file_name;
        $image->save();
        return redirect()->route('img.gallery');
    }
}
