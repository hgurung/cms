@extends('backend.master')

@section('content')


<div id="page-title">
    <h2>Dashboard</h2>
    <p>The most complete user interface framework that can be used to create stunning admin
        dashboards and presentation websites.</p>
</div>
<div class="row" style="margin-bottom:80px;">
            <div class="col-md-4">
                <a href="#" title="Example tile shortcut" class="tile-box tile-box-alt btn-success">
                    <div class="tile-header">
                        Photo Gallery
                    </div>
                    <div class="tile-content-wrapper">
                        <div class="chart-alt-10" data-percent="43"><span>43</span>%</div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="#" title="Example tile shortcut" class="tile-box tile-box-alt btn-info">
                    <div class="tile-header">
                        Subscriptions
                    </div>
                    <div class="tile-content-wrapper">
                        <div class="chart-alt-10" data-percent="76"><span>76</span>%</div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="#" title="Example tile shortcut" class="tile-box tile-box-alt btn-warning">
                    <div class="tile-header">
                        New Visitors
                    </div>
                    <div class="tile-content-wrapper">
                        <div class="chart-alt-10" data-percent="11"><span>11</span>%</div>
                    </div>
                </a>
            </div>
        </div>
<div class="row">
    <div class="col-md-4">
        <div class="dashboard-box dashboard-box-chart bg-white content-box">
            <div class="content-wrapper">
                <div class="header">
                    $34,657
                    <span>Total Earnings<b> in last</b> ten <b>quarters</b></span>
                </div>
                <div class="bs-label bg-green">+18%</div>
                <div class="center-div sparkline-big-alt">1245,1450,1312,1121,986,1489</div>
                <div class="row list-grade">
                    <div class="col-md-2">January</div>
                    <div class="col-md-2">February</div>
                    <div class="col-md-2">March</div>
                    <div class="col-md-2">April</div>
                    <div class="col-md-2">May</div>
                    <div class="col-md-2">June</div>
                </div>
            </div>
            <div class="button-pane">
                <div class="size-md float-left">
                    <a href="#" title="">
                        Financial statistics
                    </a>
                </div>
                <a href="#" class="btn btn-info float-right tooltip-button" data-placement="top"
                   title="View details">
                    <i class="glyph-icon icon-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="dashboard-box dashboard-box-chart bg-white content-box">
            <div class="content-wrapper">
                <div class="header">
                    169
                    <span>Total Subscriptions<b> in last</b> 6 days</span>
                </div>
                <div class="bs-label bg-red">-14%</div>
                <div class="center-div sparkline-big-alt">21,41,31,50,18,41</div>
                <div class="row list-grade">
                    <div class="col-md-2">M</div>
                    <div class="col-md-2">T</div>
                    <div class="col-md-2">W</div>
                    <div class="col-md-2">T</div>
                    <div class="col-md-2">F</div>
                    <div class="col-md-2">S</div>
                </div>
            </div>
            <div class="button-pane">
                <div class="size-md float-left">
                    <a href="#" title="">
                        View all members
                    </a>
                </div>
                <a href="#" class="btn btn-default float-right tooltip-button" data-placement="top"
                   title="View details">
                    <i class="glyph-icon icon-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="dashboard-box dashboard-box-chart bg-white content-box">
            <div class="content-wrapper">
                <div class="header">
                    8960
                    <span>Total Downloads<b> in last</b> 6 years</span>
                </div>
                <div class="bs-label bg-orange">~51%</div>
                <div class="center-div sparkline-big-alt">2210,2310,2010,2310,2123,2350</div>
                <div class="row list-grade">
                    <div class="col-md-2">2009</div>
                    <div class="col-md-2">2010</div>
                    <div class="col-md-2">2011</div>
                    <div class="col-md-2">2012</div>
                    <div class="col-md-2">2013</div>
                    <div class="col-md-2">2014</div>
                </div>
            </div>
            <div class="button-pane">
                <div class="size-md float-left">
                    <a href="#" title="">
                        View more details
                    </a>
                </div>
                <a href="#" class="btn btn-primary float-right tooltip-button" data-placement="top"
                   title="View details">
                    <i class="glyph-icon icon-caret-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                <h3 class="title-hero">
                    Recent sales activity
                </h3>
                <div class="example-box-wrapper">
                    <div id="data-example-1" class="mrg20B"
                         style="width: 100%; height: 300px;"></div>
                </div>
            </div>
        </div>





        <div class="content-box">
            <h3 class="content-box-header bg-default">
                <i class="glyph-icon icon-cog"></i>
                Live server status
    <span class="header-buttons-separator">
        <a href="#" class="icon-separator">
            <i class="glyph-icon icon-question"></i>
        </a>
        <a href="#" class="icon-separator refresh-button" data-style="dark" data-theme="bg-white"
           data-opacity="40">
            <i class="glyph-icon icon-refresh"></i>
        </a>
        <a href="#" class="icon-separator remove-button" data-animation="flipOutX">
            <i class="glyph-icon icon-times"></i>
        </a>
    </span>
            </h3>
            <div class="content-box-wrapper">
                <div id="data-example-3" style="width: 100%; height: 250px;"></div>
            </div>
        </div>

    </div>

</div>


@stop

@section('scripts')

<!-- Sparklines charts -->

<script type="text/javascript" src="{{URL::asset('backend/widgets/charts/sparklines/sparklines.js')}}"></script>
<script type="text/javascript"
        src="{{URL::asset('backend/widgets/charts/sparklines/sparklines-demo.js')}}"></script>

<!-- Flot charts -->

<script type="text/javascript" src="{{URL::asset('backend/widgets/charts/flot/flot.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('backend/widgets/charts/flot/flot-resize.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('backend/widgets/charts/flot/flot-stack.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('backend/widgets/charts/flot/flot-pie.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('backend/widgets/charts/flot/flot-tooltip.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('backend/widgets/charts/flot/flot-demo-1.js')}}"></script>

@stop
