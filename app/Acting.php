<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function movie() {
        return $this->belongsTo(Movie::class);
    }

    public function cast() {
        return $this->belongsTo(Cast::class);
    }
}
