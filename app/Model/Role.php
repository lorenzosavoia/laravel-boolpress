<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];
    public function users() //creo relazione many to many verso user
    {
        return $this->belongsToMany('App\User');
    }
}
