@extends('backend.master')

@section('content')

<div id="page-title">
    <h2 style="display:inline-block">{{$pageTitle}}</h2>
    <div class="right" style="float:right">
      <a class="btn btn-primary" href="{{URL::to(PREFIX.'/config/pages/language/create')}}"><i class="glyph-icon icon-plus" style="margin-right:10px;"></i>Add New</a>
    </div>
</div>

<div class="breadcrumb-section clearfix">
  <ol class="breadcrumb">
    <li><a href="{{URL::to(PREFIX.'/home')}}">Home</a></li>
    <li class="active"><a href="Javascript::void();" >{{$pageTitle}}</a></li>
  </ol>
</div>

@include('errors.errors')

<div class="panel">
  <div class="panel-body">
    {!!Form::open(['method'=>'GET','url'=>PREFIX.'/config/pages/language', 'class'=>'form-horizontal'])!!}
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
                <th>Lang For</th>
                <th>Title</th>
                <th>Flag</th>
                <th>Status</th>
                <th>File</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php $a=0;@endphp
            @foreach($data as $d)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$d->lang_for}}</td>
                <td>{{$d->title}}</td>
                <td>
                  @if(!empty($d->flag) && file_exists('uploads/language/flag/'.$d->flag))
                    <img src="{{URL::asset('uploads/language/flag/'.$d->flag)}}" style="height:40px;width:40px;">
                  @else
                    No Content Found
                  @endif
                </td>
                <td>
                  <input type="checkbox" data-on-color="primary" name="status" id="status_{{$d->id}}" class="input-switch status" data-id="{{$d->id}}" data-size="medium" data-on-text="Active" data-off-text="Inactive" @if($d->status=='active'){{"checked"}}@endif >
                </td>
                <td>
                  @if(!empty($d->file) && file_exists('uploads/language/file/'.$d->file))
                    <a href="{{URL::asset('uploads/language/file/'.$d->file)}}" target="_blank">{{$d->file}}</a>
                  @else
                    No Content Found
                  @endif
                </td>
                <td>
                  <a class="btn btn-round btn-success btn_glyph" href="{{URL::to(PREFIX.'/config/pages/language/edit?id='.$d->id)}}"><i class="glyphicon glyphicon-edit"></i></a>
                  <a class="btn btn-round btn-danger" href="{{URL::to(PREFIX.'/config/pages/language/destroy?id='.$d->id)}}" data-confirm="Are you sure you want to delete?"><i class="glyphicon glyphicon-trash"></i></button>
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
    $('.status').on('switchChange.bootstrapSwitch', function (event, state) {
        var id = $(this).data('id');
        $.ajax
            ({
                url: "{{ URL::to(PREFIX.'/config/pages/language/active')}}?id="+id,
                type: 'get',
                success: function(result)
                {
                    $('#status_'+id).html(result);
                },
                error: function()
                {
                    $('#modalinfo div').html(' <div class="modal-content"><div class="modal-header"><h2>Could not complete the request.</h2></div></div>');
                    $('#modalinfo').modal('show');
                }
            });
    });
});
</script>

@stop
