<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use App\Models\User;
use Carbon\Carbon;

class ImageController extends Controller
{
    public static function getImagePath(){
        return 'img/user_'. Auth::id();
    }
    
    public static function getImageName(Request $request){
        $original_name = $request->file('uploaded_image')->getClientOriginalName();
        $image_at = Carbon::now();
        return $image_at->format('Y-m-d_H-i-s') . '_' . $original_name;
    }
    
    public function index(){
        $gallery = Image::latest()->get();
        return view('gallery.index', [
            'images' => $gallery,
        ]);
    }
    
    public function upload(Request $request){
        $image_name = $this->getImageName($request);
        $request->file('uploaded_image')->storeAs($this->getImagePath(), $image_name, 'public');
        
        $original_name = $request->file('uploaded_image')->getClientOriginalName();
        $image = new Image();
        $image->name = $original_name;
        $image->path = 'storage/'. $this->getImagePath() . '/' . $image_name;
        Auth::user()->images()->save($image);
        return redirect()->route('img.gallery');
    }
}
