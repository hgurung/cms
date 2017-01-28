@extends('layouts.app')

@section('content')

@if (count($errors) > 0)
<div class="col-md-3 center-margin text-center alert-danger alert" style="margin-bottom: 10px; border-radius: 5px; padding-top: 10px; padding-bottom: 10px;">
Error! Username / Password Incorrect
</div>
@endif
<div class="col-md-3 center-margin">
    <form class="form-signin" role="form" method="POST" action="{{ url('/system/login') }}">
      {{ csrf_field() }}
        <div class="content-box wow bounceInDown modal-content">
            <h3 class="content-box-header content-box-header-alt bg-default">
                <span class="icon-separator">
                    <i class="glyph-icon icon-cog"></i>
                </span>
                <span class="header-wrapper">
                    Admin area
                    <small>Login to your account.</small>
                </span>

            </h3>

            <div class="content-box-wrapper">

                <div class="form-group">
                    <div class="input-group">

                        {!! Form::text('username','',['class'=>'form-control','placeholder'=>'Username','autofocus' => 'autofocus'])
    !!}
                        <span class="input-group-addon bg-blue">
                            <i class="glyph-icon icon-user"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password']) !!}
                        <span class="input-group-addon bg-blue">
                            <i class="glyph-icon icon-unlock-alt"></i>
                        </span>
                    </div>
                </div>

                <button class="btn btn-success btn-block">Log In</button>
            </div>
        </div>
    </form>
</div>

@endsection
