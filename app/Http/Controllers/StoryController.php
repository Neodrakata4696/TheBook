<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Character;
use App\Models\StoryCharacter;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WriteStory;

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
        $characters = StoryCharacter::where('story_id', $story->id)->get();
        
        return view('stories.story', [
            'story' => $story,
            'characters' => $characters,
        ]);
    }
    
    public function createForm(){
        $characters = Character::all();
        return view('stories.create', [
            "characters" => $characters,
        ]);
    }
    
    public function create(WriteStory $request){
        $request->session()->forget(["story_session", "characters_session"]);
        $story_session = $request->only($this->story_input);
        
        $request->session()->put("story_session", $story_session);
        $characters = [];
        if ($request->input('characters') !== null){
            foreach ($request->input('characters') as $character){
                $characters[] = $character;
            }
            $request->session()->put('characters_session', $characters);
        }
        
        $request->session()->put('token', csrf_token());
        return redirect()->route('stories.createConfirm');
    }
    
    public function createConfirm(Request $request){
        if (!$request->session()->exists('token')){
            return redirect()->route('stories.create');
        }
        
        $story_session = $request->session()->get("story_session");
        $characters_session = $request->session()->get("characters_session");
        $characters = [];
        
        if ($characters_session){
            $characterBox = Character::all();
            foreach($characters_session as $character_session){
                $character = $characterBox->find($character_session);
                $characters[] = $character->name;
            }
        }
        
        return view('stories.createConfirm', [
            "story" => $story_session,
            "characters" => $characters,
        ]);
    }
    
    public function createSend(Request $request){
        $story_session = $request->session()->get("story_session");
        $characters_session = $request->session()->get("characters_session");
        
        $story = new Story;
        
        $story->title = $story_session['title'];
        $story->contents = $story_session['contents'];
        Auth::user()->stories()->save($story);
        
        if($characters_session){
            $characterBox = Character::all();
            foreach ($characters_session as $character_session){
                $character = $characterBox->find($character_session);
                $storyChara = new StoryCharacter;
                $storyChara->story_id = $story->id;
                $storyChara->character_id = $character->id;
                $storyChara->save();
            }
        }
        
        $request->session()->forget(["story_session", "characters_session", "token"]);
        return redirect()->route('stories.story', [
            "story" => $story->id,
        ])->with('message', '作成完了しました');
    }
    
    public function editForm(Story $story){
        $user = Auth::user();
        $story = $user->stories()->findOrFail($story->id);
        $characters = Character::all();
        $storyCharas = StoryCharacter::where('story_id', $story->id);
        
        return view('stories.edit', [
            "story" => $story,
            "characters" => $characters,
        ]);
    }
    
    public function edit(Story $story, Request $request){
        $user = Auth::user();
        $story = $user->stories()->findOrFail($story->id);
        
        $request->session()->forget(["story_session", "characters_session"]);
        $story_session = $request->only($this->story_input);
        
        $request->session()->put("story_session", $story_session);
        
        $characters = [];
        if ($request->input('characters') !== null){
            foreach ($request->input('characters') as $character){
                $characters[] = $character;
            }
            $request->session()->put('characters_session', $characters);
        }
        
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
        
        $characters_session = $request->session()->get("characters_session");
        $characters = [];
        if ($characters_session){
            $characterBox = Character::all();
            foreach($characters_session as $character_session){
                if ($character_session !== null){
                    $character = $characterBox->find($character_session);
                    $characters[] = $character->name;
                }
            }
        }
        
        return view('stories.editConfirm', [
            "story_id" => $story,
            "story" => $story_session,
            "characters" => $characters,
        ]);
    }
    
    public function editSend(Story $story, Request $request){
        $user = Auth::user();
        $story = $user->stories()->findOrFail($story->id);
        
        $story_session = $request->session()->get("story_session");
        $characters_session = $request->session()->get("characters_session");
        
        $story->title = $story_session['title'];
        $story->contents = $story_session['contents'];
        $story->save();
        
        if($characters_session){
            $characterBox = Character::all();
            foreach ($characters_session as $character_session){
                if($character_session !== null){
                    $character = $characterBox->find($character_session);
                    if(!$story->isAppendCharacter($character)){
                        $storyChara = new StoryCharacter;
                        $storyChara->story_id = $story->id;
                        $storyChara->character_id = $character->id;
                        $storyChara->save();
                    }
                }
            }
        }
        $storyCharacterBox = StoryCharacter::where('story_id', $story->id)->whereNotIn('character_id', $characters_session)->delete();
        
        $request->session()->forget(["story_session", "characters_session", "token", "story_id_session"]);
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
