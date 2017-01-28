<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

  protected $guarded = ['id', '_token'];

  protected $fillable = ['user_id','module','data'];

  public function getAllData($data=array()){
    $language = Log::query();
    if(isset($data['keywords'])){
      $language->where('module','LIKE','%'.$data['keywords'].'%')->orWhere('data','LIKE','%'.$data['keywords'].'%');
    }
    return $language->paginate(20);
  }

  public function getUserById($userId){
    $userName = "N/A";
    $userData = User::where('id',$userId)->first();
    if(!empty($userData)){
      $userName = $userData->name;
    }
    return $userName;
  }
}
