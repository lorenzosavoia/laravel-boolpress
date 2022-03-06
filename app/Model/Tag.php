<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];
    public function posts() //relazione many to many tra post e tag verso il model di post
    {
        return $this->belongsToMany('App\Model\Post')->withTimestamps();
    }
}
