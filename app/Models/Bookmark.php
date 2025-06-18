<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmark extends Model
{
    use HasFactory;
    
    protected $table = 'bookmarks';
    
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    
    public function character(): BelongsTo{
        return $this->belongsTo(Character::class);
    }
}
