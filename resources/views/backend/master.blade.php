<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title> EKCMS - @yield('title') </title>
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
<div id="sb-site">
    <div id="page-wrapper">
        <div id="page-header" class="bg-gradient-9">
            <div id="mobile-navigation">
                <button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target="#page-sidebar">
                    <span></span></button>
                <a href="{{URL::to(PREFIX.'/home')}}" class="logo-content-small" title="MonarchUI"></a>
            </div>
            <div id="header-logo" class="logo-bg">
                <a href="{{URL::to(PREFIX.'/home')}}" class="logo-content-big" title="MonarchUI">
                    Monarch <i>UI</i>
                    <span>The perfect solution for user interfaces</span>
                </a>
                <a href="{{URL::to(PREFIX.'/home')}}" class="logo-content-small" title="MonarchUI">
                    Monarch <i>UI</i>
                    <span>The perfect solution for user interfaces</span>
                </a>
                <a id="close-sidebar" href="#" title="Close sidebar">
                    <i class="glyph-icon icon-angle-left"></i>
                </a>
            </div>


            <div id="header-nav-left">
                <div class="user-account-btn dropdown">
                    <a href="#" title="My Account" class="user-profile clearfix" data-toggle="dropdown">
                        <img width="28" src="{{URL::asset('backend/image-resources/gravatar.jpg')}}" alt="Profile image'">
                        <span>{{Auth::user()->name}}</span>
                        <i class="glyph-icon icon-angle-down"></i>
                    </a>

                    <div class="dropdown-menu float-left">
                        <div class="box-sm">
                            <div class="login-box clearfix">
                                <div class="user-info">
                                    <span>
                                        {{Auth::user()->name}}
                                    </span>
                                    <a href="{{URL::to(PREFIX.'/user/pages/users/password?id='.Auth::user()->id)}}" title="Edit profile">Change Password</a>
                                </div>
                            </div>

                            <div class="pad5A button-pane button-pane-alt text-center">
                                <a href="{{URL::to('/system/logout')}}" class="btn display-block font-normal btn-danger">
                                    <i class="glyph-icon icon-power-off"></i>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- #header-nav-right -->

        </div>
        <div id="page-sidebar">
            <div class="scroll-sidebar">

              @include('backend.sidebar')

            </div>
        </div>
        <div id="page-content-wrapper">
            <div id="page-content">

                  @yield('content')

            </div>
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

    <script>
    $(document).ready(function() {
      $('a[data-confirm]').click(function(ev) {
        var href = $(this).attr('href');
        if (!$('#dataConfirmModal').length) {
          $('body').append('<div id="dataConfirmModal"  class="modal modal-attr" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Please Confirm</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button><a class="btn btn-primary" id="dataConfirmOK">OK</a></div></div>');
        }
        $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
        $('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show:true});
        return false;
      });
    });
    </script>

</div>

  @yield('scripts')

</body>
</html>
