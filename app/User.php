<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'photo'
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

    /**
     * The method returns the image url from user.
     *
     * @return string
     */
    public function getPhotoUrl(){
        $filename = $this->photo ? $this->photo : 'user-default.jpg';
        return url('/').'/storage/'.$filename;
    }


    /**
     * The method returns is the user is a admin user.
     *
     * @return bool
     */
    public function isAdmin(){
        return $this->role_id == 1;
    }

}
