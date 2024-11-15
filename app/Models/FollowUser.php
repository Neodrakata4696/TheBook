<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FollowUser extends Model
{
    use HasFactory;
    
    protected $fillable = ['following_user_id', 'followed_user_id'];
    
    protected $table = 'follow_users';
    
    public function following(): BelongsTo{
        return $this->belongsTo(User::class, 'following_user_id');
    }
    
    public function followed(): BelongsTo{
        return $this->belongsTo(User::class, 'followed_user_id');
    }
}
