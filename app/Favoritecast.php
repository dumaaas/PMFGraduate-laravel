<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favoritecast extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function cast() {
        return $this->belongsTo(Cast::class);
    }
}
