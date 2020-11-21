<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likeable extends Model
{
    protected $guarded = [];

    public function likeable() {
        return $this->morphTo();
    }
}
