<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthUser extends Model
{
    //
    protected $fillable = [
        'type', 'name','openid' , 'access_token','last_login_ip','login_times','is_admin','email',
    ];

}
