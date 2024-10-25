<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Character;
use Illuminate\Auth\Access\HandlesAuthorization;

class CharacterPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    
    public function view(User $user, Character $chara){
        return $user->id === $chara->user_id;
    }
}
