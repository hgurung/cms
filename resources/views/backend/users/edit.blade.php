@extends('backend.master')

@section('content')

<div id="page-title">
        <h2 style="display:inline-block">Edit Users</h2>
        <div class="clearfix"></div>
</div>

<div class="breadcrumb-section clearfix">
  <ol class="breadcrumb">
    <li><a href="{{URL::to(PREFIX.'/home')}}">Home</a></li>
    <li><a href="{{URL::to(PREFIX.'/user/pages/users')}}" >Users</a></li>
    <li class="active"><a href="Javascript::void();" >Edit User</a></li>
  </ol>
</div>

@include('errors/errors')
<div class="panel">
  <div class="panel-body" style="padding:60px 60px;">
    {!!Form::open(['method'=>'POST','url'=>PREFIX.'/user/pages/users/update', 'class'=>'form-horizontal bordered-row'])!!}
    <input type="hidden" name="id" value="{{$data->id}}">
      <div class="form-group">
        <label class="col-sm-3 control-label">Name</label>
        <div class="col-sm-6">
            <input type="text" name="name" placeholder="Name" class="form-control" value="{{$data->name}}">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Email</label>
        <div class="col-sm-6">
            <input type="text" name="email" placeholder="Email" class="form-control" value="{{$data->email}}">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Username</label>
        <div class="col-sm-6">
            <input type="text" name="username" placeholder="Username" class="form-control" value="{{$data->username}}">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Roles</label>
        <div class="col-sm-6">
            {!! Form::select('roles',$roles,$data->rolesUser->role_id,['class'=>'form-control']) !!}
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">&nbsp;</label>
        <div class="col-sm-6">
          <div class="pull-right">
            <a class="btn btn-primary" href="{{URL::to(PREFIX.'/user/pages/users')}}"><i class="glyphicon glyphicon-chevron-left" style="margin-right:10px;"></i>Back</a>
            <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-ok" style="margin-right:10px;"></i>Save</button>
          </div>
        </div>
      </div>
      {!!Form::close() !!}
      <div class="clearfix"></div>

    </div>
</div>


@stop

@section('scripts')

<style>
.form-horizontal .control-label{
text-align:left;
}
</style>

@stop
