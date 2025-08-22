<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Character extends Model
{
    use HasFactory;
    
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    
    public function story(): BelongsTo{
        return $this->belongsTo(Story::class);
    }
    
    public function image(): BelongsTo{
        return $this->belongsTo(Image::class);
    }
    
    public function bookmarks() {
        return $this->hasMany('App\Models\Bookmark');
    }
}
