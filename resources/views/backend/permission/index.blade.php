@extends('backend.master')

@section('content')

<div id="page-title">
    <h2 style="display:inline-block">{{$pageTitle}}</h2>
    <!-- <div class="right" style="float:right">
      <a class="btn btn-primary" href="{{URL::to(PREFIX.'/user/pages/permission/create')}}"><i class="glyph-icon icon-plus" style="margin-right:10px;"></i>Add New</a>
    </div> -->
</div>

<div class="breadcrumb-section clearfix">
  <ol class="breadcrumb">
    <li><a href="{{URL::to(PREFIX.'/home')}}">Home</a></li>
    <li class="active"><a href="Javascript::void();" >Permission</a></li>
  </ol>
</div>

@include('errors.errors')

<div class="panel">
  <div class="panel-body">
    {!!Form::open(['method'=>'GET','url'=>PREFIX.'/user/pages/permission', 'class'=>'form-horizontal'])!!}
      <div class="form-group">

        <div class="col-sm-3"></div>
        <div class="col-md-4"></div>
        <label class="col-sm-2 control-label">Search</label>
          <div class="col-md-3">
            <div class="input-group">

                <input type="text" class="form-control" name="keywords" value="{{Input::get('keywords')}}">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Go!</button>
                </span>

            </div>
          </div>
      </div>
    {!!Form::close() !!}
    <div class="example-box-wrapper">
      <div class="scroll-columns">
        <table class="table table-bordered table-striped table-condensed cf">
          <thead class="cf">
            <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php $a=0;@endphp
            @foreach($data as $d)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$d->name}}</td>
                <td>{{$d->slug}}</td>
                <td>
                  <a class="btn btn-round btn-success btn_glyph" href="{{URL::to(PREFIX.'/user/pages/permission/edit?id='.$d->id)}}"><i class="glyphicon glyphicon-edit"></i></a>
                  <!-- <a class="btn btn-round btn-danger" href="{{URL::to(PREFIX.'/user/pages/permission/destroy?id='.$d->id)}}" data-confirm="Are you sure you want to delete?"><i class="glyphicon glyphicon-trash"></i></button> -->
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <ul class="pagination" style="float:right">
      {!! str_replace('/?', '?',$data->appends(['keywords'=>Input::get('keywords')])->render()) !!}
    </ul>
      <div class="clearfix"></div>

</div>
</div>

@stop

@section('scripts')

<link rel="stylesheet" type="text/css" href="{{URL::asset('backend/widgets/input-switch/inputswitch.css')}}">

<script type="text/javascript" src="{{URL::asset('backend/widgets/input-switch/inputswitch.js')}}"></script>
<script type="text/javascript">
/* Input switch */

$(function() { "use strict";
    $('.input-switch').bootstrapSwitch();
});
</script>

@stop
