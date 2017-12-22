    <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Post Office Admin Panel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ URL::asset('public/bootstrap/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
<script>
    var consoleLog = console.log;
//    console.log= function (){};
</script>
    <link rel="stylesheet" href="{{ URL::asset('public/dist/css/AdminLTE.min.css')}}">

    <link rel="stylesheet" href="{{ URL::asset('public/css/admin/formater.css')}}">
    <link href="{{URL::asset('public/site/css/formats.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('public/site/css/main.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->

    <link rel="stylesheet" href="{{ URL::asset('public/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('public/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('public/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('public/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('public/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('public/css/mdl-jquery-modal-dialog.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('public/css/material.deep_orange-amber.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('public/plugins/datatables/select.dataTables.min.css')}}">

    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="{{ URL::asset('public/dist/css/skins/skin-blue.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('public/css/datepicker.css')}}">
    <link href="{{URL::asset('/public/site/fonts/materialicons/material-icons.css')}}" rel="stylesheet" type="text/css" />
@yield('header')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    {{--<![endif]-->--}}
    <style>
        [data-field],[contenteditable="true"] {
            cursor: text;
        }
        .dialog-container h5{
            margin-top: 0!important;
        }
        [data-field]:active {

        }
        [data-field]:focus ,[contenteditable="true"]:focus {
            background-color: #eee;
        }
        .empty-value {
            border-bottom:1px dashed red!important;
        }
        .content-wrapper {
            /*background-color: #fff !important;*/
        }
        .dialog-container {
            position: fixed;
        }
        .edit-able:focus {

        }
        .edit-able {
            outline: none;
        }
        .fr-element.fr-view {
            background-color: #fff;
        }

         .template {
             display:none;
         }
        .table-teachers td {
            font-size: 20px;
        }
        .gallery-container .mdl-button {
            height: unset!important;
        }
        #teachers-tbody td {
            vertical-align: middle;
        }
        .mdl-color2 {
            color:#000;
            background: #fff;
        }
        .mdl-color2:focus {
            color:#000;
            background: #fdfdfd;
        }
        .loading-container{
            position:fixed!important;
        }
        .material-like .modal-content{
            border-radius: 2px;
            padding:20px!important;
        }
        .material-like .modal-content .modal-header,.material-like .modal-content .modal-footer{
            border:none!important;
        }

        .mdl-color2:active {
            color:#000;
            background: #dedede;
        }
        .main-sidebar {background-color:#222d32;!important;overflow-x: hidden}
        .main-sidebar li a {
            width: 100%;


        }
        body,.wrapper {
            background-color: #ecf0f5!important;
        }
        .wrapper {
            position: unset!important;

        }
        .mdl-color2:focus:not(:active) {
            color:#000;
            background: #fefefe;
        }
        .mdl-color1 {
            color:#fff;
            background: #00a65a;
        }
        .mdl-color1:focus {
            color:#fff;
            background: #00a65a;
        }
        .mdl-color1:active {
            color:#fff;
            background: #00a65a;
        }
        .mdl-color1:focus:not(:active) {
            color:#fff;
            background: #00a65a;
        }
        .mdl-button.mdl-color1:hover {
            background: #008246;
        }
        [data-placeholder]:not([data-div-placeholder-content]):before {

            content: attr(data-placeholder);

            /*float: left;*/

            margin-left: 2px;

            color: #b3b3b3;

        }

    </style>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<script>
    var bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    var en = ['0','1','2','3','4','5','6','7','8','9'];
</script>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{url('/home')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>P</b>M</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Post</b>Master</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li  class="mdl-button mdl-button--raised color2 mt-4 mr-16"><span href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                            >Sign out</span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form></li>


                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar" style="    height: 100%;">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->

<div style="background-color: #222;color:#fff;font-family: Roboto;padding:15px;font-size:20px"><i class="material-icons" style="margin-top: -5px">account_circle</i>&nbsp;<span class="pt-10">{{\Illuminate\Support\Facades\Auth::user()->name}}</span></div>
            <!-- search form (Optional) -->
        {{--<form action="#" method="get" class="sidebar-form">--}}
        {{--<div class="input-group">--}}
        {{--<input type="text" name="q" class="form-control" placeholder="Search...">--}}
        {{--<span class="input-group-btn">--}}
        {{--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
        {{--</button>--}}
        {{--</span>--}}
        {{--</div>--}}
        {{--</form>--}}
        <!-- /.search form -->

            <!-- Sidebar Menu -->
        @include('partials/sidebar')
        <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @if(isset($contentHeader))
            <section class="content-header">
                <h1>
                    {{$contentHeader}}
                </h1>
                {{--<ol class="breadcrumb">--}}
                {{--<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>--}}
                {{--<li class="active">Here</li>--}}
                {{--</ol>--}}
            </section>
    @endif

    <!-- Main content -->
        <section class="content">
            <?php
            if(Session::has('flashmessage')) {
            $message=Session::get('flashmessage');


            ?>

            {{--<div class="col-md-12">--}}
                <div class="alert alert-{{$message->status=="ok"?'success':'danger'}} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                    {{$message->message}}

                </div>
            {{--</div>--}}
            <?php

            }
            ?>
        @yield('content')
        <!-- Your Page Content Here -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->


    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<div class="property-window p-20 position-fixed" style="display: none;">
    <table>
        <tr>
            <td class="p-10 f-15">Padding</td>
            <td class="p-10 f-15"><input class="range-type-1 element-padding" type="range"></td>
        </tr>
        <tr class="margin-tr" style="display: none">
            <td class="p-10 f-15">Margin</td>
            <td class="p-10 f-15"><input class="range-type-1 element-margin" type="range"></td>
        </tr>
        <tr class="for-text-element">
            <td class="p-10 f-15">Line Height</td>
            <td class="p-10 f-15"><input class="range-type-1 element-line-height" type="range"></td>
        </tr>
        <tr class="for-text-element">
            <td class="p-10 f-15">Font-Size</td>
            <td class="p-10 f-15"><input class="range-type-1 element-font-size" type="range" min="10" max="50"></td>
        </tr>

    </table>
    <div class="t-c mt-20 align-container" style="border:1px solid #ddd">
        <i class="fa fa-align-left p-10" data-class="t-l"></i>

        <i class="fa fa-align-center p-10" data-class="t-c"></i>
        <i class="fa fa-align-right p-10" data-class="t-r"></i>
        <i class="fa fa-align-justify p-10" data-class="t-j"></i>
        <i class="fa fa-bold p-10 b" data-class="b"></i>

    </div>

    <div class="content-hori">
        <div style="width: 50%">
            <div class="t-c mt-20 p-10 w-100 right-panel-button save" style="border:1px solid #ddd">
                Save
            </div>
        </div>
        <div style="width: 50%" class="pl-10">
            <div class="t-c mt-20 p-10 w-100  right-panel-button cancel" style="border:1px solid #ddd">
                Reset
            </div>
        </div>
    </div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3.2.1 -->

<script src="{{ URL::asset('public/common/js/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ URL::asset('public/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('public/dist/js/app.min.js')}}"></script>
<script src="{{ URL::asset('public/dist/js/app.min.js')}}"></script>
<script src="{{ URL::asset('public/plugins/datatables/jquery.dataTables.min.js')}}"></script>
{{--<script src="{{ URL::asset('public/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>--}}
<script src="{{ URL::asset('public/plugins/datatables/dataTables.select.min.js')}}"></script>

<script src="{{ URL::asset('public/js/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ URL::asset('public/dist/js/demo.js')}}"></script>
<script src="{{ URL::asset('public/js/jquery-ui.js')}}"></script>
<script src="{{ URL::asset('public/common/js/httpcalls.js')}}"></script>
<script src="{{ URL::asset('public/js/datepicker.min.js')}}"></script>
<script src="{{ URL::asset('public/js/xl-toast.js')}}"></script>
<script src="{{ URL::asset('public/js/material.min.js')}}"></script>
<script src="{{ URL::asset('public/js/autoNumeric.js')}}"></script>
<script src="{{ URL::asset('public/js/mdl-jquery-modal-dialog.js')}}"></script>
<script src="{{ URL::asset('public/js/jquery.tmpl.js')}}"></script>

@yield('footer-script')


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

</body>
</html>
