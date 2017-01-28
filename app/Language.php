<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
  protected $guarded = ['id', '_token'];

  protected $fillable = ['lang_for','default','flag','status','title','file','slug'];

  public function getAllData($data=array()){
    $language = Language::query();
    if(isset($data['keywords'])){
      $language->where('title','LIKE','%'.$data['keywords'].'%');
    }
    return $language->paginate(20);
  }
}
