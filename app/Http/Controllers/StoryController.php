<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    private $story_input = ["title", "contents"];
    
    public function index(){
        $stories = Story::query()->latest()->paginate(15);
        
        return view('stories.index', [
            'stories' => $stories,
        ]);
    }
    
    public function storyPage(Story $story){
        $story->findOrFail($story->id);
        
        return view('stories.story', [
            'story' => $story,
        ]);
    }
    
    public function createForm(){
        return view('stories.create');
    }
    
    public function create(Request $request){
        $request->session()->forget(["story_session"]);
        $story_session = $request->only($this->story_input);
        
        $request->session()->put("story_session", $story_session);
        
        $request->session()->put('token', csrf_token());
        return redirect()->route('stories.createConfirm');
    }
    
    public function createConfirm(Request $request){
        if (!$request->session()->exists('token')){
            return redirect()->route('stories.create');
        }
        
        $story_session = $request->session()->get("story_session");
        
        return view('stories.createConfirm', [
            "story" => $story_session,
        ]);
    }
    
    public function createSend(Request $request){
        $story_session = $request->session()->get("story_session");
        
        $story = new Story;
        
        $story->title = $story_session['title'];
        $story->contents = $story_session['contents'];
        Auth::user()->stories()->save($story);
        $request->session()->forget(["story_session", "token"]);
        return redirect()->route('stories.story', [
            "story" => $story->id,
        ])->with('message', '作成完了しました');
    }
    
    public function editForm(Story $story){
        $user = Auth::user();
        $story = $user->stories()->findOrFail($story->id);
        
        return view('stories.edit', [
            "story" => $story,
        ]);
    }
    
    public function edit(Story $story, Request $request){
        $user = Auth::user();
        $story = $user->stories()->findOrFail($story->id);
        
        $request->session()->forget(["story_session"]);
        $story_session = $request->only($this->story_input);
        
        $request->session()->put("story_session", $story_session);
        
        $request->session()->put("token", csrf_token());
        $request->session()->put("story_id_session", $story->id);
        return redirect()->route('stories.editConfirm', [
            "story" => $story,
        ]);
    }
    
    public function editConfirm(Story $story, Request $request){
        $user = Auth::user();
        $story = $user->stories()->findOrFail($story->id);
        if (!$request->session()->exists('token')){
            return redirect()->route('stories.edit', [
                "story" => $story,
            ]);
        }
        else if ($request->session()->get("story_id_session") !== $story->id){
            return redirect()->route('stories.edit', [
                "story" => $story,
            ]);
        }
        
        $story_session = $request->session()->get("story_session");
        if (!$story_session){
            return redirect()->route('stories.edit', [
                "story" => $story,
            ]);
        }
        
        return view('stories.editConfirm', [
            "story_id" => $story,
            "story" => $story_session,
        ]);
    }
    
    public function editSend(Story $story, Request $request){
        $user = Auth::user();
        $story = $user->stories()->findOrFail($story->id);
        
        $story_session = $request->session()->get("story_session");
        
        $story->title = $story_session['title'];
        $story->contents = $story_session['contents'];
        $story->save();
        $request->session()->forget(["story_session", "token", "story_id_session"]);
        return redirect()->route('stories.story', [
            "story" => $story,
        ])->with('message', '更新完了しました');
    }
    
    public function deleteForm(Story $story, Request $request){
        $user = Auth::user();
        $story = $user->stories()->findOrFail($story->id);
        
        return view('stories.delete', [
            "story" => $story,
        ]);
    }
    
    public function delete(Story $story, Request $request){
        $user = Auth::user();
        $story = $user->stories()->findOrFail($story->id);
        
        $story->delete();
        
        return redirect()->route('stories.index');
    }
}
