<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    /**
     * @var mixed
     */

    public function user() {
        return $this->belongsTo(User::class);

    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'following_user_id', 'user_id')
                    ->withTimestamps();
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'user_id', 'following_user_id')
                    ->withTimestamps();
    }

}
