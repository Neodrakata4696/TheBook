<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $table = 'users';
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function characters(){
        return $this->hasMany('App\Models\Character');
    }
    
    public function images(){
        return $this->hasMany('App\Models\Image');
    }
    
    public function followUsers(){
        return $this->belongsToMany('App\Models\User', 'follow_users', 'followed_user_id', 'following_user_id');
    }
    
    public function follows(){
        return $this->belongsToMany('App\Models\User', 'follow_users', 'following_user_id', 'followed_user_id');
    }
    
    public function isFollowedBy($user): bool {
        return FollowUser::where('followed_user_id', $this->id)->where('following_user_id', $user->id)->first() !== null;
    }
}
