<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'path',
    ];
    
    protected $table = 'images';
    
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
