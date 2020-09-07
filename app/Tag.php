<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function itemTags()
    {
        return $this->hasMany('App\ItemTag');
    }
}
