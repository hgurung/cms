<?php

namespace App\Http\Controllers\Admin\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Html;
use Image;
use File;
use App\User;
use App\Role;
use App\Permission;
use App\RoleUser;
use App\Http\Requests\UsersRequest;

class usersController extends Controller
{

  public function __construct(User $users,Permission $permisionModel)
  {
      $this->pageTitle = "Users";
      $this->model = $users;
      $this->permisionModel = $permisionModel;
      $this->redirectUrl = PREFIX."/user/pages/users";
  }

  public function index()
  {
      $pageTitle = $this->pageTitle;
      $data = $this->model->getAllData(Input::all());
      return view('backend.users.index',compact('data','pageTitle','roles'));
  }

  public function create(UsersRequest $request)
  {

      $roles = [""=>'Please Select'] + Role::pluck('name','id')->all();
      return view('backend.users.create',compact('roles','permission'));
  }

  public function store(UsersRequest $request)
  {
      try {
          $attributes            = $request->all();
          $rolesData = Role::where('id',$request->roles)->first();
          if(!$rolesData){
            return redirect()->back()->withErrors(['Internal Sever Error']);
          }
          $insertedData['name'] = $request->name;
          $insertedData['username'] = $request->username;
          $insertedData['email'] = $request->email;
          $insertedData['password'] = $request->password;
          try{
            $usersData = $this->model->create($insertedData);
            $roleData['user_id'] = $usersData->id;
            $roleData['role_id'] = $rolesData->id;
            RoleUser::create($roleData);
            return redirect($this->redirectUrl)->withErrors(['alert-success'=>'Successfully Added']);
          }
          catch (Exception $e) {
              return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not saved!']);
          }

      } catch (Exception $e) {
          return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not saved!']);
      }
  }

  public function edit(UsersRequest $request)
  {
      $pageTitle = $this->pageTitle;
      $data = $this->model->find(Input::get('id'));
      if(empty($data)){
        return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not found!']);
      }
      $roles = [""=>'Please Select'] + Role::pluck('name','id')->all();
      return view('backend.users.edit', compact('data','pageTitle','roles','permission'));
  }

  public function update(UsersRequest $request)
  {
      $usersData = $this->model->find($request->id);
      $attributes            = $request->all();
      $rolesData = Role::where('id',$request->roles)->first();
      if(!$rolesData){
        return redirect()->back()->withErrors(['Internal Sever Error']);
      }
      $insertedData['name'] = $request->name;
      $insertedData['username'] = $request->username;
      $insertedData['email'] = $request->email;
      try {
          $attributes = Input::except('_token');;
          $usersData->update($insertedData);
          RoleUser::where('user_id',$usersData->id)->delete();
          $roleData['user_id'] = $usersData->id;
          $roleData['role_id'] = $rolesData->id;
          RoleUser::create($roleData);
          return redirect($this->redirectUrl)->withErrors(['alert-success'=>'Successfully Updated']);
      } catch (Exception $e) {
          return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not saved!']);
      }

  }

  public function password(UsersRequest $request)
  {
    $id                   = $request->id;
    $data = $this->model->where('id',$id)->first();
    if(empty($data)){
      return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not found!']);
    }
    return view('backend.users.changepass', compact('data'));
  }

  public function updatepassword(UsersRequest $request){
    $id                   = $request->id;
    $data = $this->model->where('id',$id);
    if(empty($data)){
      return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not found!']);
    }
    $insertedData['password'] = bcrypt($request->password);
    $data->update($insertedData);
    return redirect($this->redirectUrl)->withErrors(['alert-success'=>'Successfully Updated']);
  }

  public function destroy(UsersRequest $request)
  {
      if($this->model->count()==1){
        return redirect()->back()->withErrors(['There must be one admin']);
      }
      try {
          $users = $this->model->find(Input::get('id'));
          $t = $users->delete();
          RoleUser::where('user_id',$users->id)->delete();
          return redirect()->back()->withErrors(['alert-success'=>'Successfully Deleted']);
      } catch (Exception $e) {
          return redirect()->back()->withErrors(['alert-danger'=>$e->message]);
      }

  }
}
