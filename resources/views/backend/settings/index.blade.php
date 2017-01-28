@extends('backend.master')

@section('content')

<div id="page-title">
        <h2 style="display:inline-block">Website Configuration</h2>

        <div class="clearfix"></div>
</div>

<div class="breadcrumb-section clearfix">
  <ol class="breadcrumb">
    <li><a href="{{URL::to(PREFIX.'/home')}}">Home</a></li>
    <li class="active"><a href="Javascript::void();" >Website Configuration</a></li>
  </ol>
</div>

@include('errors.errors')

<div class="panel">
  <div class="panel-body" style="padding:60px 60px;">
    <style>
    .form-horizontal .control-label{
      text-align:left;
      }
    </style>
    {!!Form::open(['files'=>'true','method'=>'POST','url'=>PREFIX.'/config/pages/settings/store', 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}

    <div class="form-group">
      <label class="col-sm-3 control-label">Meta Title </label>
      <div class="col-sm-6">
          <textarea rows="4" class="form-control" name="meta_title" id="exampleInputEmail1" placeholder="Meta Title">{{$data->meta_title}}</textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Meta Keywords </label>
      <div class="col-sm-6">
          <textarea rows="4" class="form-control" name="meta_keywords" id="exampleInputEmail1" placeholder="Meta Kaywords">{{$data->meta_keywords}}</textarea>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label">Meta Description </label>
      <div class="col-sm-6">
          <textarea rows="4" class="form-control" name="meta_descriptions" id="exampleInputEmail1" placeholder="Meta Descriptions">{{$data->meta_descriptions}}</textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Phone1 </label>
      <div class="col-sm-6">
        <input type="number" name="phone1" class="form-control" placeholder=" First Phone No" value="{{$data->phone1}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Phone2 </label>
      <div class="col-sm-6">
        <input type="number" name="phone2" class="form-control" placeholder=" Second Phone No" value="{{$data->phone2}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Mobile No </label>
      <div class="col-sm-6">
        <input type="text" name="mobile_no" class="form-control" placeholder=" Mobile Number" value="{{$data->mobile_no}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Email Address </label>
      <div class="col-sm-6">
        <input type="text" name="email" class="form-control" placeholder=" Email Address" value="{{$data->email}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Contact Email Address </label>
      <div class="col-sm-6">
        <input type="text" name="public_email" class="form-control" placeholder=" Email Address" value="{{$data->public_email}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Latitude </label>
      <div class="col-sm-6">
        <input type="text" name="latitude" class="form-control" placeholder="Latitude" value="{{$data->latitude}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Longitude </label>
      <div class="col-sm-6">
        <input type="text" name="longitude" class="form-control" placeholder="Longitude" value="{{$data->longitude}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Facebook </label>
      <div class="col-sm-6">
        <input type="text" name="fb_link" class="form-control" placeholder="Facebook link" value="{{$data->fb_link}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Twitter </label>
      <div class="col-sm-6">
        <input type="text" name="twitter_link" class="form-control" placeholder="Twitter link" value="{{$data->twitter_link}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Youtube </label>
      <div class="col-sm-6">
        <input type="text" name="youtube_link" class="form-control" placeholder="Youtube link" value="{{$data->youtube_link}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Skype </label>
      <div class="col-sm-6">
        <input type="text" name="skype_link" class="form-control" placeholder="Skype" value="{{$data->skype_link}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Instagram </label>
      <div class="col-sm-6">
        <input type="text" name="instagram_link" class="form-control" placeholder="Instagram" value="{{$data->instagram_link}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Website main title </label>
      <div class="col-sm-6">
        <input type="text" name="main_title" class="form-control" placeholder="Main title" value="{{$data->main_title}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Website scondary title </label>
      <div class="col-sm-6">
        <input type="text" name="secondary_title" class="form-control" placeholder="Additional title" value="{{$data->secondary_title}}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Time Zone </label>
      <div class="col-sm-6">
        {!! Form::select('time_zone',$timezoneData,$data->time_zone,['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6 col-md-offset-3">
        <div class="right" style="float:right">
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
