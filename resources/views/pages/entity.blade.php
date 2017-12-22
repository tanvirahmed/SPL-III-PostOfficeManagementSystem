@extends('layouts.admin')

@section('header')
    <style>
        td.details {
            cursor: pointer;
        }
        .paginate_button:hover {
         background-color: #ddd
        ;
        }

        .paginate_button.current {
            color:#fff!important;
            background-color: #333;
            box-shadow:0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12)
        }
        .dataTables_paginate {
            margin-bottom:20px
        }
        .dataTables_paginate .paginate_button {
            cursor: pointer;
            border-radius: 4px;
            margin:10px;
            padding:10px;
            font-family: Roboto;
            font-size: 15px;
            color:#000;

        }
    </style>
@endsection

@section('content')

   <section class="content-header pl-1">
       <h1>
           {{$pagetitle}}

       </h1>

   </section>

   <div style="display: none" class="row mt-20">
       <div class="col-md-3 col-sm-6 col-xs-12">
           <div class="info-box">
               <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

               <div class="info-box-content">
                   <span class="info-box-text">CPU Traffic</span>
                   <span class="info-box-number">90<small>%</small></span>
               </div>
               <!-- /.info-box-content -->
           </div>
           <!-- /.info-box -->
       </div>
       <!-- /.col -->
       <div class="col-md-3 col-sm-6 col-xs-12">
           <div class="info-box">
               <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

               <div class="info-box-content">
                   <span class="info-box-text">Likes</span>
                   <span class="info-box-number">41,410</span>
               </div>
               <!-- /.info-box-content -->
           </div>
           <!-- /.info-box -->
       </div>
       <!-- /.col -->

       <!-- fix for small devices only -->
       <div class="clearfix visible-sm-block"></div>

       <div class="col-md-3 col-sm-6 col-xs-12">
           <div class="info-box">
               <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

               <div class="info-box-content">
                   <span class="info-box-text">Sales</span>
                   <span class="info-box-number">760</span>
               </div>
               <!-- /.info-box-content -->
           </div>
           <!-- /.info-box -->
       </div>
       <!-- /.col -->
       <div class="col-md-3 col-sm-6 col-xs-12">
           <div class="info-box">
               <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

               <div class="info-box-content">
                   <span class="info-box-text">New Members</span>
                   <span class="info-box-number">2,000</span>
               </div>
               <!-- /.info-box-content -->
           </div>
           <!-- /.info-box -->
       </div>
       <!-- /.col -->
   </div>

   <div class="row mt-20">
       <div class="col-xs-12">

           <!-- /.box -->

           <div class="box">
               <div class="box-header">
                   {{--<h3 class="box-title">Data Table With Full Features</h3>--}}
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <table id="datatable" class="table table-bordered table-striped">
@include($partial,["entities"=>$entities])

                   </table>
               </div>
               <!-- /.box-body -->
           </div>
           <!-- /.box -->
       </div>
       <!-- /.col -->
   </div>

@endsection
@section('footer-script')
    <div class=" m-10   position-fixed content-hori mdl-shadow--16dp " style="border-radius: 4px;bottom:0;right: 0;position:fixed;background-color: #fff" >
        <div class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color2" style="color:#000;border-right: 1px solid #dedede" id="add-entity" data-t="#add-entity-template">Add</div>
        <div class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color2" style="color:#000;border-right: 2px solid #dedede" id="edit-entity">Edit</div>
        <div class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color2" style="color:#000" id="delete-entity">Delete</div>
    </div>
    <script id="add-entity-template" type="text/x-jquery-tmpl">
    <div class="t-c" >
        <form action="{{route($add)}}" method="post" class="t-c">
        <div class="form-group w-70 t-c" style="margin:auto">
                  <label for="inputEmail3" class=" control-label">Number of {{$pagetitle}}</label>

                  <div class="w-30" style="margin:auto">
                    <input type="text" class="form-control" name="number" placeholder="Number">
                  </div>
                </div>
        </form>
</div>
    </script>
    <form action="{{route($edit)}}" method="post" class="t-c" style="display:none" id="edit-form">
        <input name="ids"/>
        @if(isset($type))
        <input name="type" value="{{$type}}"/>
        @endif
    </form>
    <form action="{{route($delete)}}" method="post" class="t-c" style="display:none" id="delete-form">
        <input name="ids"/>
    </form>
    <script>

        $(function () {

            window.datatable =$('#datatable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                columnDefs: [ {
                    orderable: false,
                    className: 'select-checkbox',
                    targets:   0
                } ],
                select: {
                    style:    'os',
                    selector: 'td:first-child'
                }

            });
            $("#datatable_filter input").addClass("form-control")
            $("#datatable_filter label").css({'width':'100%'})
//            $(".paginate_button").addClass("mdl-button ")
            $(".dataTables_paginate").addClass("t-c");
        });
    </script>
    <script src="{{asset('public/js/related/entity.js')}}"></script>
@endsection