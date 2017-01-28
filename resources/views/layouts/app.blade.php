<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Loading Spinner */
        .spinner{margin:0;width:70px;height:18px;margin:-35px 0 0 -9px;position:absolute;top:50%;left:50%;text-align:center}.spinner > div{width:18px;height:18px;background-color:#333;border-radius:100%;display:inline-block;-webkit-animation:bouncedelay 1.4s infinite ease-in-out;animation:bouncedelay 1.4s infinite ease-in-out;-webkit-animation-fill-mode:both;animation-fill-mode:both}.spinner .bounce1{-webkit-animation-delay:-.32s;animation-delay:-.32s}.spinner .bounce2{-webkit-animation-delay:-.16s;animation-delay:-.16s}@-webkit-keyframes bouncedelay{0%,80%,100%{-webkit-transform:scale(0.0)}40%{-webkit-transform:scale(1.0)}}@keyframes bouncedelay{0%,80%,100%{transform:scale(0.0);-webkit-transform:scale(0.0)}40%{transform:scale(1.0);-webkit-transform:scale(1.0)}}
    </style>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title> EK CMS Login </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/bootstrap/css/bootstrap.css')}}">


    <!-- HELPERS -->

   <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/helpers/animate.css')}}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/helpers/backgrounds.css')}}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/helpers/boilerplate.css')}}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/helpers/utils.css')}}">
   <!-- for graph -')}}->

   <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/helpers/colors.css')}}">

    <!-- ELEMENTS -->

    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/elements/badges.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/elements/content-box.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/elements/dashboard-box.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/elements/panel-box.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/elements/tile-box.css')}}">

    <!-- ICONS -->

    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/icons/fontawesome/fontawesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/icons/linecons/linecons.css')}}">



    <!-- WIDGETS -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/widgets/charts/piegage/piegage.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/widgets/dropdown/dropdown.css')}}">

    <!-- SNIPPETS -->

    <!-- Admin theme -->

    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/themes/admin/layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/themes/admin/color-schemes/default.css')}}">

    <!-- Components theme -->

    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/themes/components/default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/themes/components/border-radius.css')}}">

    <!-- Admin responsive -->

    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/helpers/responsive-elements.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/helpers/admin-responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/themes/admin/bemita.css')}}">

    <!-- JS Core -->

    <script type="text/javascript" src="{{URL::asset('backend/js-core/jquery-core.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('backend/js-core/modernizr.js')}}"></script>

</head>
<body>


<style type="text/css">

    html,body {
        height: 100%;
        background: #fff;
        overflow: hidden;
    }

</style>


<!-- <script type="text/javascript" src="{{ URL::asset('backend/widgets/wow/wow.js') }}"></script>
<script type="text/javascript">
    /* WOW animations */

    wow = new WOW({
        animateClass: 'animated',
        offset: 100
    });
    wow.init();
</script> -->


<img src="{{URL::asset('backend/image-resources/blurred-bg/blurred-bg-3.jpg')}}" class="login-img wow fadeIn" alt="">

<div class="center-vertical">
    <div class="center-content row">

        @yield('content')

    </div>
</div>



<!-- WIDGETS -->

<script type="text/javascript" src="{{URL::asset('backend/bootstrap/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('backend/widgets/superclick/superclick.js')}}"></script>

<!-- Input switch alternate -->

<script type="text/javascript" src="{{URL::asset('backend/widgets/input-switch/inputswitch-alt.js')}}"></script>

<!-- Slim scroll -->

<script type="text/javascript" src="{{URL::asset('backend/widgets/slimscroll/slimscroll.js')}}"></script>

<!-- Slidebars -->

<script type="text/javascript" src="{{URL::asset('backend/widgets/slidebars/slidebars.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('backend/widgets/slidebars/slidebars-demo.js')}}"></script>

<!-- PieGage -->

<script type="text/javascript" src="{{URL::asset('backend/widgets/charts/piegage/piegage.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('backend/widgets/charts/piegage/piegage-demo.js')}}"></script>

<!-- Screenfull -->

<script type="text/javascript" src="{{URL::asset('backend/widgets/screenfull/screenfull.js')}}"></script>



<!-- Widgets init for demo -->

<script type="text/javascript" src="{{URL::asset('backend/js-init/widgets-init.js')}}"></script>

<!-- Theme layout -->

<script type="text/javascript" src="{{URL::asset('backend/themes/admin/layout.js')}}"></script>
</body>
</html>
