<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
class users extends Authenticatable
{
    //
    use Notifiable;

    protected $table='users';
    protected $filltable=[
        'email','password'
    ];
    protected $hidden=[
        'password','remember_token',
    ];

    protected $casts=[
        'email_vertified_at'=>'datetime',
    ];
}
