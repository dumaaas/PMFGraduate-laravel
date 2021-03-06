<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['user', 'likes'];
    protected $appends = ['repliesCount'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function commentable() {
        return $this->morphTo();
    }

    public function likes() {
        return $this->morphMany(Likeable::class, 'likeable');
    }

    public function replies() {
        return $this->hasMany(Comment::class, 'comment_id')->whereNotNull('comment_id');
    }

    public function getRepliesCountAttribute() {
        return $this->replies->count();
    }

    public function isCommentLiked($id) {
        return $this->likes()->where('user_id', '=', Auth::user()->id)->where('likeable_id', '=', $id)->where('liked', 'LIKE', 'up')->exists();
    }
}
