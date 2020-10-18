<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded = [];

    public function acting() {
        return $this->hasMany(Acting::class);
    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }

    public function custom() {
        return $this->hasMany(Custom::class);
    }

    public function favorite() {
        return $this->hasMany(Favorite::class);
    }

    public function rating() {
        return $this->hasMany(Rating::class);
    }

    public function watched() {
        return $this->hasMany(Watched::class);
    }

    public function watchlist() {
        return $this->hasMany(Watchlist::class);
    }

    public function scopeFilterByName($query, $name, $boolean = 'or')
{
    if ($name) {
        return $query->where('name','LIKE', '%'.$name.'%');
    }
}

}
