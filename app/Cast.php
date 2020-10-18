<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    protected $guarded = [];

    public function acting() {
        return $this->hasMany(Acting::class);
    }

    public function favoriteCast() {
        return $this->hasMany(Favoritecast::class);
    }
}
