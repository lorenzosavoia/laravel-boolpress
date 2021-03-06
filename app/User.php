<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function userInfo() // faccio relazione one to one con model userinfo
    {
        return $this->hasOne('App\Model\UserInfo');
    }
    public function posts() //creo relazione one to many col model di post 
    {
        return $this->hasMany('App\Model\Post');
    }
    public function roles()//creo relazione many to many verso role
    {
        return $this->belongsToMany('App\Model\Role');
    }
}
