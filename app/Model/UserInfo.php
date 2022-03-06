<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    public function user() //faccio relazione one to one con user
    {
        return $this->belongsTo('App\User');
    }
}
