<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['commentCount'];

    public function acting() {
        return $this->hasMany(Acting::class);
    }

    public function comment() {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('comment_id');
    }

    public function getCommentCountAttribute() {
        return $this->comment->count();
    }

    public function movielist() {
        return $this->hasMany(MovieList::class);
    }

    public function rating() {
        return $this->hasMany(Rating::class);
    }

    public function scopeFilterByName($query, $name, $boolean = 'or')
    {
        if ($name) {
            return $query->where('name','LIKE', '%'.$name.'%');
        }
    }

    public function isInMovieList($type) {
        return (bool) MovieList::where('user_id', Auth::id())
                                ->where('movie_id', $this->id)
                                ->where('type', $type)
                                ->first();
    }

}
