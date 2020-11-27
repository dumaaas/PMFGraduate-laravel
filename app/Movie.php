<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded = [];

    public function acting() {
        return $this->hasMany(Acting::class);
    }

    public function comment() {
        return $this->morphMany(Comment::class, 'commentable');
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

    public function isInMovieList() {
        return (bool) MovieList::where('user_id', Auth::id())
                                ->where('movie_id', $this->id)
                                ->first();
    }

}
