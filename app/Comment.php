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

    public function movie() {
        return $this->belongsTo(Movie::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function like($liked = true) {   
        $this->likes()->updateOrCreate([
            'user_id' => Auth::user()->id,
        ], [
            'liked' => $liked
        ]);
    }

    public function dislike() {
        return $this->like(false);
    }

    public function isLikedBy(User $user, Comment $comment) {
       return (bool) $user->likes
            ->where('comment_id', $comment->id)
            ->where('liked', true)
            ->count();
    }

    public function isDislikedBy(User $user, Comment $comment) {
        return (bool) $user->likes
            ->where('comment_id', $comment->id)
            ->where('liked', false)
            ->count();
    }

    public function scopeWithLikes(Builder $query) {
        $query->leftJoinSub(
            'select comment_id, sum(liked) likes, sum(!liked) dislikes from likes group by comment_id',
            'likes',
            'likes.comment_id',
            'comments.id'
        );
    }
}
