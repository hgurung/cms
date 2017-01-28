@extends('layouts.app')

@section('content')


<div class="center-vertical">
    <div class="center-content row">

        <div class="col-md-6 center-margin">
            <div class="server-message wow bounceInDown inverse">
                <h1>Error 404</h1>
                <h2>Page not found</h2>
                <p>The page you are looking for has been moved or no longer exists. Use the search field below to locate the page you were looking for.</p>

                <form>
                    <div class="input-group mrg25B mrg10T input-group-lg">
                        <div class="input-group-btn">

                        </div>
                    </div>
                    <a class="btn btn-lg btn-success" href="{{URL::to('/')}}">Return To Home Page</a>
                </form>
            </div>
        </div>

    </div>
</div>


@endsection
