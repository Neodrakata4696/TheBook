<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\User;

class ImageController extends Controller
{
    public function index(){
        $gallery = Image::all();
        return view('gallery.index', [
            'images' => $gallery,
        ]);
    }
    
    public function upload(Request $request){
        $dir = 'img';
        $file_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs($dir, $file_name, 'public');
        
        $image = new Image();
        $image->name = $file_name;
        $image->path = 'storage/'. $dir . '/' . $file_name;
        $image->save();
        
        return redirect()->route('img.gallery');
    }
}
