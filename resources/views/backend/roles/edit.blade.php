@extends('backend.master')

@section('content')

<div id="page-title">
        <h2 style="display:inline-block">Edit Users</h2>
        <div class="clearfix"></div>
</div>

<div class="breadcrumb-section clearfix">
  <ol class="breadcrumb">
    <li><a href="{{URL::to(PREFIX.'/home')}}">Home</a></li>
    <li><a href="{{URL::to(PREFIX.'/user/pages/roles')}}" >Roles</a></li>
    <li class="active"><a href="Javascript::void();" >Edit Role</a></li>
  </ol>
</div>

@include('errors/errors')

<div class="panel">
  <div class="panel-body" style="padding:60px 60px;">
    {!!Form::open(['method'=>'POST','url'=>PREFIX.'/user/pages/roles/update', 'class'=>'form-horizontal bordered-row'])!!}
      <input type="hidden" name="id" value="{{$data->id}}">
      <div class="form-group">
        <label class="col-sm-3 control-label">Name</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="name" placeholder="" value="{{$data->name}}">
        </div>
      </div>


      <div class="form-group">
        <label class="col-sm-3 control-label">Permission</label>
        <div class="col-sm-7">
            <div class="row">
              @foreach($permission as $key=>$module)

                <div class="col-xs-12" style="margin-top:15px; margin-bottom:3px;">
                  <strong>
                      <label>
                        <input type="checkbox" name="modules{{$key}}" value="{{$key}}" class="modulesClass modules" id="{{$key}}"
                         @if(array_key_exists($key,$userPermission)){{"checked"}}@endif>&nbsp;&nbsp;{{strtoupper($key)}}
                      </label>
                  </strong>
                </div>
                  @foreach($module as $value=>$title)
                  <div class="col-lg-3">
                    <label>
                      <input type="checkbox" name="permissions[]" id="{{$key.'_module'}}" value="{{$key.".".$value}}" class="modulesClass permission {{$key.'_module'}}"
                      <?php foreach($userPermission as $userKey=>$module){
                        foreach($module as $userP=>$titleP){
                          if($userP==$value){
                            echo "checked";
                          }
                        }
                      }
                      ?>
                      >&nbsp;&nbsp;{{$title}}&nbsp;&nbsp;
                    </label>
                  </div>
                  @endforeach
              @endforeach

            </div>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">&nbsp;</label>
        <div class="col-sm-7">
          <div class="pull-right">
            <a class="btn btn-primary" href="{{URL::to(PREFIX.'/user/pages/roles')}}"><i class="glyphicon glyphicon-chevron-left" style="margin-right:10px;"></i>Back</a>
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

<script>
  $('.modules').click(function(){
    var module = $(this);
    console.log(module.val());
    if(module.prop('checked')!==false){
        $('.permission').each(function(){
          var value = $(this).val();

          if( value.indexOf(module.val()) !== -1){
            if(value.indexOf('.view')!== -1){
              $(this).prop('checked',true);
            }
          }
        });
    }
    else{
      $('.'+module.val()+'_module').each(function(){
            console.log($(this).val());
            $(this).prop('checked',false);
      });
    }
  });

  $('.permission').click(function(){
    var permission = $(this);
    var data = permission.val().split('.');
    var module = data[0];
    if(permission.prop('checked')==false){
      var countChecked = $('.'+module+"_module:checked").length;
      if(countChecked==0){
        $('#'+module).prop('checked',false);
      }
    }
    else{

      $('#'+module).prop('checked',true);
    }
  });

</script>

@stop
