<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\CheckPermission;
use Hash;

class User extends Authenticatable
{
    use CheckPermission,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username','password','permissions'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAllData($data=array()){
      $users = User::query();
      if(isset($data['keywords'])){
        $users->where('name','LIKE','%'.$data['keywords'].'%');
      }
      return $users->paginate(20);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function rolesUser()
    {
        return $this->hasOne('App\RoleUser','user_id','id');
    }

}
