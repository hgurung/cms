<?php

namespace App\Traits;

use App\Traits\InteractsWithPermissions;
use App\Traits\HasRoles;
use Auth;
use App\Role;
/**
 * Trait HasPermission.
 */
trait CheckPermission
{
    use HasRoles, InteractsWithPermissions;

    /**
     * @var \Illuminate\Support\Collection
     */
    private $cachedPermissions;

    /**
     * @var \Illuminate\Support\Collection
     */
    private $cachedRolePermissions;

    /**
     * Returns if the current user has the given permission.
     * User permissions override role permissions.
     *
     * @param string $permission
     * @param bool   $force
     *
     * @return bool
     */
    public function hasPermission($permission, $force = false)
    {

        $permissions = $this->getAllPermissions($force);
        $check = false;
        foreach($permissions as $k=>$v) {
            if(preg_match("/\b$permission\b/i", $k)) {
                $check = true;
            }
        }
        return $check;
        //return array_key_exists($permission.".view", $permissions);
    }

    /**
     * Checks for permission
     * If has superuser group automatically passes.
     *
     * @param string $permission
     * @param bool   $force
     *
     * @return bool
     */
    public function canDo($permission, $force = false)
    {
        if ($this->isSuperUser()) {
            // If has superuser role
            return true;
        }
        return $this->hasPermission($permission, $force);
    }

    /**
     * check has superuser role.
     *
     * @return bool
     */



    public function isSuperUser()
    {
        if(Role::where('id',Auth::user()->rolesUser->role_id)->first()->name=='superuser'){
          return true;
        }else{
          return false;
        }
        //return $this->hasRole('superuser');
    }

    /**
     * Check if the user has the given permission using
     * only his roles.
     *
     * @param string $permission
     * @param bool   $force
     *
     * @return bool
     */
    public function roleHasPermission($permission, $force = false)
    {
        $permissions = $this->getRolesPermissions($force);

        return array_key_exists($permission, $permissions);
    }

    /**
     * Retrieve all user permissions.
     *
     * @param bool $force
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllPermissions($force = false)
    {

        if (empty($this->cachedPermissions) or $force) {
            $this->cachedPermissions = $this->getFreshAllPermissions();
        }
        return $this->cachedPermissions;
    }

    /**
     * @param bool $force
     *
     * @return \Illuminate\Support\Collection
     */
    public function getRolesPermissions($force = false)
    {

        if (empty($this->cachedRolePermissions) or $force) {
            $this->cachedRolePermissions = $this->getFreshRolesPermissions();
        }
        return $this->cachedRolePermissions;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    protected function getFreshRolesPermissions()
    {
        $roles       = $this->roles()->get(['permissions']);
        $permissions = [];
        if(!empty($roles)){
          foreach ($roles as $role) {

              if (!empty($role->permissions)) {
                  $rolePermissionsJson = json_decode($role->permissions);
                  $rolePermissions = $this->getGroupedPermissions($rolePermissionsJson);
                  $permissions = array_merge($permissions, $rolePermissions);
              }

          }
        }
        return $permissions;
    }

    public function getGroupedPermissions($result){
      $array = [];
      foreach ($result as $key => $value) {
          //$key                      = explode('.', $key, 2);
          @$array[$key] = $value;
      }
      return $array;
    }

    /**
     * Get fresh permissions from database.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getFreshAllPermissions()
    {
        $permissionsRoles = $this->getRolesPermissions(true);
        $permissions = empty($this->permissions) ? [] : $this->permissions;
        $permissions = array_merge($permissions, $permissionsRoles);

        return $permissions;
    }

    /**
     * Find a user by its id.
     *
     * @param int $id
     *
     * @return \Litepie\User\Contracts\User
     */
    public function findById($id)
    {
        return $this->find($id);
    }

    public function allUserPermission(){
        $roles       = $this->roles()->get(['permissions']);
        $permissions = [];
        if(!empty($roles)){
          foreach ($roles as $role) {

              if (!empty($role->permissions)) {
                  $rolePermissionsJson = json_decode($role->permissions);
                  $rolePermissions = $this->groupedUserPermissions($rolePermissionsJson);
                  $permissions = array_merge($permissions, $rolePermissions);
              }

          }
        }
        return $permissions;
    }

    public function groupedUserPermissions($result)
    {
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

}
