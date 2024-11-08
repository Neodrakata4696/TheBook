<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FollowUser;
use Illuminate\Support\Facades\Auth;

class FollowUserController extends Controller
{
    public function follow(User $user) {
        $check = FollowUser::where('following_user_id', Auth::user()->id)->where('followed_user_id', $user->id);
        
        if($check->count() == 0):
            $follow = new FollowUser;
            $follow->following_user_id = Auth::user()->id;
            $follow->followed_user_id = $user->id;
            $follow->save();
        endif;
        
        return redirect()->route('charas.prindex', $user->id);
    }

    public function unfollow(User $user) {
        $unfollowing = FollowUser::where('following_user_id', Auth::user()->id)->where('followed_user_id', $user->id)->delete();
        
        return redirect()->route('charas.prindex', $user->id);
    }
}
