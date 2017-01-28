@extends('backend.master')

@section('content')

<div id="page-title">
        <h2 style="display:inline-block">Add New Language</h2>
        <div class="clearfix"></div>
</div>

<div class="breadcrumb-section clearfix">
  <ol class="breadcrumb">
    <li><a href="{{URL::to(PREFIX.'/home')}}">Home</a></li>
    <li><a href="{{URL::to(PREFIX.'/config/pages/language')}}" >Language</a></li>
    <li class="active"><a href="Javascript::void();" >Create Language</a></li>
  </ol>
</div>

@include('errors/errors')

<div class="panel">
  <div class="panel-body" style="padding:60px 60px;">
    <style>
    .form-horizontal .control-label{
      text-align:left;
      }
    </style>
    {!!Form::open(['files'=>'true','method'=>'POST','url'=>PREFIX.'/config/pages/language/store', 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}

    <div class="form-group">
      <label class="col-sm-3 control-label">Language For *</label>
      <div class="col-sm-6">
          <select class="form-control" name="lang_for">
              <option value="">Please Select</option>
              <option value="backend">Backend</option>
              <option value="frontend">Frontend</option>
          </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Title *</label>
      <div class="col-sm-6">
          <input type="text" class="form-control" name="title" placeholder="" value="{{Input::old('title')}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Slug *</label>
      <div class="col-sm-6">
          <input type="text" class="form-control" name="slug" placeholder="E.g en,jp" value="{{Input::old('slug')}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Upload Flag Image</label>
      <div class="col-sm-6">
          <input type="file" class="form-control" name="flag" placeholder="" value="{{Input::old('flag')}}">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label">Upload Language File*</label>
      <div class="col-sm-6">
          <input type="file" class="form-control" name="file" placeholder="" value="{{Input::old('file')}}">
      </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Default Language</label>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-md-6">
                    <div class=" radio-success" style="margin-top:8px;">
                        <label>
                            <input type="radio" id="inlineRadio111" name="default" class="custom-radio" value="yes">
                            Yes
                        </label>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class=" radio-danger" style="margin-top:8px;">
                        <label>
                            <input type="radio" id="inlineRadio112" name="default" class="custom-radio" value="no">
                            No
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Status</label>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-md-6">
                    <div class=" radio-success" style="margin-top:8px;">
                        <label>
                            <input type="radio" id="inlineRadio111" name="status" class="custom-radio" value="active">
                            Yes
                        </label>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class=" radio-danger" style="margin-top:8px;">
                        <label>
                            <input type="radio" id="inlineRadio112" name="status" class="custom-radio" value="inactive">
                            No
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label">&nbsp;</label>
      <div class="col-sm-6">
        <div class="pull-right">
          <a class="btn btn-primary" href="{{URL::to(PREFIX.'/config/pages/language')}}"><i class="glyphicon glyphicon-chevron-left" style="margin-right:10px;"></i>Back</a>
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
