@extends('layouts.admin')

@section('header')
    <style>
        .details label{
            opacity: .4;
            color:#444!important;
        }
        .details h4 {
            margin-top: 0!important;
        }
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
    <div id="orrsLoader" class="loading-container" style="opacity: 1;"><div><div class="mdl-spinner mdl-js-spinner is-active is-upgraded" data-upgraded=",MaterialSpinner"><div class="mdl-spinner__layer mdl-spinner__layer-1"><div class="mdl-spinner__circle-clipper mdl-spinner__left"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__gap-patch"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__circle-clipper mdl-spinner__right"><div class="mdl-spinner__circle"></div></div></div><div class="mdl-spinner__layer mdl-spinner__layer-2"><div class="mdl-spinner__circle-clipper mdl-spinner__left"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__gap-patch"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__circle-clipper mdl-spinner__right"><div class="mdl-spinner__circle"></div></div></div><div class="mdl-spinner__layer mdl-spinner__layer-3"><div class="mdl-spinner__circle-clipper mdl-spinner__left"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__gap-patch"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__circle-clipper mdl-spinner__right"><div class="mdl-spinner__circle"></div></div></div><div class="mdl-spinner__layer mdl-spinner__layer-4"><div class="mdl-spinner__circle-clipper mdl-spinner__left"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__gap-patch"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__circle-clipper mdl-spinner__right"><div class="mdl-spinner__circle"></div></div></div></div></div></div>
   <section class="content-header pl-1">
       <h1>
      @if($parcel->type==1)
           Parcel
@else
          Money Order
           @endif
       </h1>

   </section>

   <div class="row mt-20">
       <div class="col-md-12">
       <div class="box box-default color-palette-box details">

           <div class="box-body">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="exampleInputEmail1">Sender Name</label>
            <h4 >{{$parcel->sender_name}}</h4>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Source Post Office</label>
            <h4 >{{$parcel->sourcePostOffice()->first()->name}}</h4>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Sender Mobile No</label>
            <h4 >{{strlen($parcel->sender_phone)==0?"Not listed":$parcel->sender_phone}}</h4>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="exampleInputEmail1">Receiver Name</label>
            <h4 id="source">{{$parcel->sender_name}}</h4>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" >Current Post Office</label>
            <?php $current =$parcel->currentPostOffice()->first() ;
                if($current==null)$current=$parcel->sourcePostOffice()->first();
            ?>
            <h4 id="current" >{{$current->name}}</h4>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Receiver Mobile No</label>
            <h4 >{{strlen($parcel->receiver_phone)==0?"Not listed":$parcel->receiver_phone}}</h4>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="exampleInputEmail1">Tracking Id</label>
            <h4 >{{$parcel->tracking_id}}</h4>

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Destination Post Office</label>
            <h4 >{{$parcel->destinationPostOffice()->first()->name}}</h4>
        </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Receiver Address</label>
            <h4 >{{$parcel->receiver_address}}</h4>
        </div>
    </div>

</div>
           </div>
           <!-- /.box-body -->
           <div class="box-footer t-r">
               <form action="{{route('editParcel')}}" method="post">
                   <input type="hidden" value="[{{$parcel->id}}]" name="ids"/>
                   <input type="hidden" value="[{{$parcel->type}}]" name="type"/>
               <button type="submit" class="btn btn-primary">Edit</button>
               </form>
           </div>
       </div>
       <!-- /.col -->
   </div>

   </div>
    <div class="row"> <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    {{--<h3 class="box-title">Data Table With Full Features</h3>--}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        @include('partials.tracktableparcel',["entities"=>$tracks])

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div></div>

@endsection
@section('footer-script')
    <script id="track-row" type="text/x-jquery-tmpl">
            <tr data-id="${id}">

        <td></td>
        <td>${current}</td>
        <td>${next}</td>
        <td>${status}</td>


    </tr>
    </script>
    @if($branch!=null)
    <script id="add-track-template" type="text/x-jquery-tmpl">
    <div>
    <div class="row" data-action="{{route('addTrack')}}">

        <?php
        $postOffices = \App\Models\Branch::all();
        $statuses = \App\Models\ParcelStatus::all();
        ?>
        <input name="parcel" type='hidden' value="{{$parcel->id}}" >
    {{--<div class="col-md-4">--}}
        {{--<div class="form-group">--}}
            {{--<label for="exampleInputEmail1">Current Post Office</label>--}}
            {{--<select class="form-control" name="current">--}}
{{--<option value="" >Choose</option>--}}
            {{--@foreach($postOffices as $office)--}}
            {{--<option value="{{$office->id}}">{{$office->name}}</option>--}}
                {{--@endforeach--}}
        {{--</select>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="col-md-4">
        <div class="form-group">
        <label for="exampleInputEmail1">Status</label>
        <select class="form-control" name="status">
        <option value="" >Choose</option>
        @foreach($statuses as $status)
            <option value="{{$status->id}}">{{$status->title}}</option>
                @endforeach
        </select>
        </div>
    </div>

    <div class="col-md-4">

    @if($parcel->destination_post_office!=$branch->id)
        <div class="form-group">
        <label for="exampleInputEmail1">Next PostOffice</label>
        <select class="form-control" name="next">
        <option value="" >Choose</option>
        @foreach($postOffices as $office)
            <option value="{{$office->id}}">{{$office->name}}</option>
                @endforeach
        </select>
        </div>
        @else
        <div>{{$parcel->type==2?"Money Order":"Parcel"}} has reached destination</div>
        <input type="hidden" value="0" name="next"/>
        @endif

    </div>

</div>

</div>
</div>

</script>
    @endif
    <form action="{{route('showInMap')}}" method="post" id="map-form">
        <input name="parcel" value="{{$parcel->id}}"/>

    </form>
    <div class=" m-10   position-fixed content-hori mdl-shadow--16dp " style="border-radius: 4px;bottom:0;right: 0;position:fixed;background-color: #fff" >
        @if($branch!=null && (($parcel->current_post_office == $branch->id || $parcel->next_post_office == $branch->id || $parcel->destination_post_office == $branch->id) || ($parcel->current_post_office == 0 && $parcel->source_post_office == $branch->id)))
        <div class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color2" style="color:#000;border-right: 1px solid #dedede" id="add-entity" data-t="#add-track-template">Add Track</div>
            <div class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color2" style="color:#000" id="delete-entity">Delete</div>
        @endif
        <div class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color2" style="color:#000;border-right: 2px solid #dedede" id="show-in-map">Show in Map</div>
        {{--<div class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color2" style="color:#000;border-right: 2px solid #dedede" id="edit-entity">Edit</div>--}}

    </div>
    <script>
        var delete_url = '{{route('deleteTrack')}}';
    </script>
    <script src="{{asset('public/js/related/tracks.js')}}"></script>
    <script>

        $(function () {
hideLoading();
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
@endsection