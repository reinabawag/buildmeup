<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemTag extends Model
{
    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
