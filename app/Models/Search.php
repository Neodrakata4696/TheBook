<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    /**
     * @param string $keyword
     * @return Array
     */
    public function pregSplit($keyword){
        $keyword = mb_convert_kana( $keyword, "s" );
        return preg_split('/[\p{Z}\p{Cc}]++/u', $keyword, -1, PREG_SPLIT_NO_EMPTY);
    }
    
    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @var string[]|false $keywords
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function searchQuery($query, $keywords = null){
        if(!empty($keywords)) {
            foreach ($keywords as $keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")->orWhere('explain', 'LIKE', "%{$keyword}%");
                });
            }
        }
        return $query->latest()->paginate(15);
    }
    
    public function escape(string $value = null){
        if (!$value) {
            return $value;
        }
        
        return str_replace(
            ['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $value
        );
    }
}
