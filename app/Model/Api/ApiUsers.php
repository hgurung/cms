<?php

namespace App\Model\Api;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ApiUsers extends Authenticatable
{
    use HasApiTokens, Notifiable;
    
    protected $table = 'api_users';

    protected $fillable = [
        'email',
        'password',
        'status',
        'token',
        'type',
        'created_at',
        'updated_at',
    ];

    public function addUsers($userData)
    {
       return ApiUsers::create($userData);
    }

    public function profile()
    {
        return $this->hasOne('App\Model\Api\ApiUsersProfile','user_id','id');
    }

    public function getUserDataByToken($token)
    {
     return ApiUsers::where('token',$token)->first();
    }

}