<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoryCharacter extends Model
{
    use HasFactory;
    
    protected $table = "story_characters";
    
    public function story(): BelongsTo{
        return $this->belongsTo(Story::class);
    }
    
    public function character(): BelongsTo{
        return $this->belongsTo(Character::class);
    }
}
