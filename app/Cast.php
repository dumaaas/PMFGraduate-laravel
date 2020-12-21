<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function acting() {
        return $this->hasMany(Acting::class);
    }

    public function likes() {
        return $this->morphMany(Likeable::class, 'likeable');
    }

    public function isInFavoriteCast($id) {
        return $this->likes()->where('user_id', '=', Auth::user()->id)->where('likeable_id', '=', $id)->where('liked', 'LIKE', 'up')->exists();
    }
}
