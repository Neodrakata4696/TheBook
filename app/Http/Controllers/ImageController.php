<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use App\Models\User;
use App\Http\Requests\ImageRequest;
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
        $gallery = Image::orderBy('id', 'DESC')->paginate(30);
        return response()->view('gallery.index', [
            'images' => $gallery,
        ]);
    }
    
    public function detail(Image $image){
        $image->findOrFail($image->id);
        
        return view('gallery.detail', [
            'image' => $image,
            'image_name' => $image->name,
            'image_path' => $image->path,
        ]);
    }
    
    public function upload(ImageRequest $request){
        $image_name = $this->getImageName($request);
        $request->file('uploaded_image')->storeAs($this->getImagePath(), $image_name, 'public');
        
        $original_name = $request->file('uploaded_image')->getClientOriginalName();
        $info_name = pathinfo($original_name, PATHINFO_FILENAME);
        $image = new Image();
        $image->name = $info_name;
        $image->path = 'storage/'. $this->getImagePath() . '/' . $image_name;
        Auth::user()->images()->save($image);
        return redirect()->route('img.gallery');
    }
}
