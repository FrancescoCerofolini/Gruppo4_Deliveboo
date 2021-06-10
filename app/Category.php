<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable ['name'];

    public function restaurants()
    {
        return $this->belongsToMany('App\Restaurant');
        
    }
}
