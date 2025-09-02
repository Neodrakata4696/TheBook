<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Story extends Model
{
    use HasFactory;
    
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    
    public function character(): BelongsTo{
        return $this->belongsTo(Character::class);
    }
    
    public function isAppendCharacter($chara): bool{
        return StoryCharacter::where('story_id', $this->id)->where('character_id', $chara->id)->first() !== null;
    }
}
