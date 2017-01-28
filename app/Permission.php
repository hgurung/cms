<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

  protected $table = "permissions";

  protected $fillable = ['name','slug'];

  protected $guarded = ['id', '_token'];

  public function getAllData($data=array()){
    $this->insertDefaultPermissionFromConfig();
    $permission = Permission::query();
    if(isset($data['keywords'])){
      $permission->where('name','LIKE','%'.$data['keywords'].'%')
                  ->orWhere('slug','LIKE','%'.$data['keywords'].'%');
    }
    return $permission->paginate(20);
  }

  public function insertDefaultPermissionFromConfig(){
    $permissionArray = array();
    foreach(config('cmsconfig.modulepermissions') as $permission):
      foreach($permission as $slug=>$name){
        $array['slug'] = $slug;
        $array['name'] = $name;
        if(Permission::where('slug',$slug)->count()==0){
          Permission::create($array);
        }
      }
    endforeach;
  }

  public function groupedPermissions($grouped = false)
  {
      $result = Permission::orderBy('slug')->pluck('name', 'slug')->all();

      $array = [];

      foreach ($result as $key => $value) {
          $key                      = explode('.', $key, 2);
          if(count($key)==1){
            @$array[$key[0]][$key[0]] = $value;
          }
          else{
            @$array[$key[0]][$key[1]] = $value;
          }


      }
      return $array;
  }

    public function createPermission($data)
    {
        $data['slug'] = is_null($data['slug']) ? $data['name'] : $data['slug'];
        return Permission::create($data);
    }

    public function updatePermission($data){

    }

    /**
     * @param array $rolesIds
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByRoles(array $rolesIds)
    {
        return Permission::whereHas('roles', function ($query) use ($rolesIds) {
            $query->whereIn('id', $rolesIds);
        })->get();
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

}
