<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

  protected $guarded = ['id', '_token'];

  protected $fillable = ['name','permissions'];

  public function users()
  {
      return $this->belongsToMany('App\User');
  }

  public function getAllData($data=array()){
    $role = Role::query();
    if(isset($data['keywords'])){
      $role->where('name','LIKE','%'.$data['keywords'].'%');
    }
    return $role->paginate(20);
  }

  public function getUserRoles($id){
    $permisssionArray=array();
    $role = Role::where('id',$id)->first();
    $permission = $role->permissions;
    if($permission!=null){
      //dd(json_decode($permission));
      foreach(json_decode($permission) as $key=>$value){
        $key                      = explode('.', $key, 2);
        @$permisssionArray[$key[0]][$key[1]] = $value;
        //echo "<pre>";print_r($key);
        // if(count($key)==1){
        //   @$permisssionArray[$key[0]][$key[0]] = $value;
        // }
        // else{
        //   @$permisssionArray[$key[0]][$key[1]] = $value;
        // }
      }
    }
    return $permisssionArray;
  }

}
