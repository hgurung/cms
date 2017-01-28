<?php

namespace App\Http\Controllers\Admin\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use Validator;
use Input;
use App\Http\Requests\PermissionRequest;
use Session;
class permissionController extends Controller
{
  public function __construct(Permission $permission)
  {
      $this->pageTitle = "User Permission";
      $this->model = $permission;
      $this->redirectUrl = PREFIX."/user/pages/permission";
  }

  public function index()
  {
      $pageTitle = $this->pageTitle;
      $data = $this->model->getAllData(Input::all());
      return view('backend.permission.index',compact('data','pageTitle'));
  }

  public function create(PermissionRequest $request)
  {

      return view('backend.permission.create');

  }

  public function store(PermissionRequest $request)
  {
      try {
          $attributes            = $request->all();
          $permission            = $this->model->createPermission($attributes);
          return redirect($this->redirectUrl)->withErrors(['alert-success'=>'Successfully Added']);
      } catch (Exception $e) {
          return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not saved!']);
      }
  }

  public function edit(PermissionRequest $request)
  {
      $pageTitle = $this->pageTitle;
      $data = $this->model->find(Input::get('id'));
      if(empty($data)){
        return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not found!']);
      }
      return view('backend.permission.edit', compact('data','pageTitle'));
  }

  public function update(PermissionRequest $request)
  {
      $permissionData = $this->model->where('id', $request->id);
      try {
          $attributes = Input::except('_token');;
          $permissionData->update($attributes);
          return redirect($this->redirectUrl)->withErrors(['alert-success'=>'Successfully Updated']);
      } catch (Exception $e) {
          return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not saved!']);
      }

  }

  public function destroy(PermissionRequest $request)
  {
      try {
          $permission = $this->model->find(Input::get('id'));
          $t = $permission->delete();
          return redirect()->back()->withErrors(['alert-success'=>'Successfully Deleted']);
      } catch (Exception $e) {
          return redirect()->back()->withErrors(['alert-danger'=>$e->message]);
      }

  }
}
