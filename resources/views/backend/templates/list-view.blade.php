@extends('backend.master')

@section('content')

<div id="page-title">
        <h2 style="display:inline-block">Templates List View</h2>

        <div class="clearfix"></div>
</div>

<div class="breadcrumb-section clearfix">
  <ol class="breadcrumb">
    <li><a href="{{URL::to(PREFIX.'/home')}}">Home</a></li>
    <li class="active"><a href="Javascript::void();" >Templates List View</a></li>
  </ol>
</div>

@include('backend.templates.includes.table-view')
@include('backend.templates.includes.button-view')

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
