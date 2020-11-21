<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model
{

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function commentable() {
        return $this->morphTo();
    }

    public function likes() {
        return $this->morphMany(Likeable::class, 'likeable');
    }

    public function isCommentLiked($id) {
        return $this->likes()->where('user_id', '=', Auth::user()->id)->where('likeable_id', '=', $id)->where('liked', 'LIKE', 'up')->exists();
    }
}
