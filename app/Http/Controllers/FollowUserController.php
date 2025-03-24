<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FollowUser;
use App\Models\Character;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FollowUserController extends Controller
{
    public function followIndex(User $user) {
        $user->findOrFail($user->id);
        $followeds = FollowUser::where('following_user_id', $user->id)->latest()->paginate(15);
        
        return view('follow.follow', [
            'followeds' => $followeds,
            'user_name' => $user->name,
        ]);
    }
    
    public function followerIndex(User $user) {
        $user->findOrFail($user->id);
        $followings = FollowUser::where('followed_user_id', $user->id)->latest()->paginate(15);
        
        return view('follow.follower', [
            'followings' => $followings,
            'user_name' => $user->name,
        ]);
    }
    
    public function follow(User $user) {
        $check = (boolean) $user->isFollowedBy(Auth::user());
        
        if ($check):
            $follow = FollowUser::where('following_user_id', Auth::user()->id)->where('followed_user_id', $user->id)->delete();
        else:
            $follow = new FollowUser;
            $follow->following_user_id = Auth::user()->id;
            $follow->followed_user_id = $user->id;
            $follow->save();
        endif;
        
        return response()->json($follow);
    }
}
