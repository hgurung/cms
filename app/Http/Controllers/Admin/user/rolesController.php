<?php

namespace App\Http\Controllers\Admin\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Validator;
use Input;
use App\Http\Requests\RolesRequest;
use App\Http\Requests\RolesUpdateRequest;
use Session;
class rolesController extends Controller
{
  public function __construct(Role $roles,Permission $permission)
  {
      $this->pageTitle = "User Roles";
      $this->model = $roles;
      $this->permissionModel = $permission;
      $this->redirectUrl = PREFIX."/user/pages/roles";
  }

  public function index()
  {
      $pageTitle = $this->pageTitle;
      $data = $this->model->getAllData(Input::all());
      return view('backend.roles.index',compact('data','pageTitle'));
  }

  public function create(RolesRequest $request)
  {

      $permission = $this->permissionModel->groupedPermissions();
      return view('backend.roles.create',compact('permission'));

  }

  public function edit(RolesRequest $request){
    $data = $this->model->find($request->id);
    if(empty($data)){
      return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not found!']);
    }
    $userPermission = $this->model->getUserRoles($request->id);
    $permission = $this->permissionModel->groupedPermissions();
    return view('backend.roles.edit',compact('permission','userPermission','data'));
  }

  public function store(RolesRequest $request)
  {
      try {
          $attributes            = $request->all();
          $module = '{"home.view":"1",';
          foreach($request->permissions as $p){
            $module .= '"'.$p.'"'.':'.'"1"'.',';
          }
          $moduleData = rtrim($module, ',')."}";
          $attributes['permissions'] = $moduleData;
          $roles            = $this->model->create($attributes);
          return redirect($this->redirectUrl)->withErrors(['alert-success'=>'Successfully Added']);
      } catch (Exception $e) {
          return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not saved!']);
      }
  }

  public function update(RolesRequest $request)
  {
      $rolesData = $this->model->find($request->id);
      try {
          $attributes            = $request->all();
          $module = '{"home.home.view":"1",';
          foreach($request->permissions as $p){
            $module .= '"'.$p.'"'.':'.'"1"'.',';
          }
          $moduleData = rtrim($module, ',')."}";
          $attributes['permissions'] = $moduleData;
          $rolesData->update($attributes);
          return redirect($this->redirectUrl)->withErrors(['alert-success'=>'Successfully Updated']);
      } catch (Exception $e) {
          return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not saved!']);
      }
  }

  public function destroy(RolesRequest $request)
  {
      $roles = $this->model->find($request->id);
      try {
          if($roles->name=='superuser'){
            return redirect()->back()->withErrors(['You cannot delete superuser']);
          }
          $t = $roles->delete();
          return redirect()->back()->withErrors(['alert-success'=>'Successfully Deleted']);
      } catch (Exception $e) {
          return redirect()->back()->withErrors([$e->message]);
      }

  }

}
