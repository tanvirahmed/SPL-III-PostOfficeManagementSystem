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
           Parcel #{{$parcel->id}}

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
                       </div>
                       <div class="col-md-4">
                           <div class="form-group">
                               <label for="exampleInputEmail1">Receiver Name</label>
                               <h4 >{{$parcel->sender_name}}</h4>
                           </div>
                           <div class="form-group">
                               <label for="exampleInputEmail1">Destination Post Office</label>
                               <h4 >{{$parcel->destinationPostOffice()->first()->name}}</h4>
                           </div>
                       </div>
                       <div class="col-md-4">
                           <div class="form-group">
                               <label for="exampleInputEmail1">Tracking Id</label>
                               <h4 >{{$parcel->tracking_id}}</h4>
                           </div>
                           <div class="form-group">
                               <label for="exampleInputEmail1">Destination Post Office</label>
                               <h4 >{{$parcel->receiver_address}}</h4>
                           </div>
                       </div>
                   </div>
               </div>
               <!-- /.box-body -->
               <div class="box-footer t-r">
                   <form action="{{route('editParcel')}}" method="post">
                       <input type="hidden" value="[{{$parcel->id}}]" name="ids"/>
                       <button type="submit" class="btn btn-primary">Edit</button>
                   </form>
               </div>
           </div>
           <!-- /.col -->
       </div>

   </div>
<div class="row mt-20">
    <div class="col-md-6">
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
    </div>
        <div class="col-md-6" style="min-height: 300px">
   <div id="map" style="width: 300px; height: 300px; position: absolute;">
       <div id="map-canvas"></div>
   </div>
        </div>


</div>


@endsection
@section('footer-script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQ6Q_ntdD4Hyrgf_QIPWCeQXpm5YEId4Y&callback=initMap"
            async defer></script>
    <script>
//        $(function()
        function initMap(){


        var geocoder;
        var map;
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
            <?php 
                    $source =$parcel->sourcePostOffice()->first(); 
                    $destination =$parcel->destinationPostOffice()->first(); 
                    ?>
        var locations = [
            ['{{$source->name}}',{{preg_replace('/[^0-9.]+/', '', $source->lat)}},{{preg_replace('/[^0-9.]+/', '', $source->llong)}}],

                    @foreach($tracks as $track)
                ['{{$track->currentPostOffice()->first()->name}}',{{preg_replace('/[^0-9.]+/', '', $track->currentPostOffice()->first()->lat)}},{{preg_replace('/[^0-9.]+/', '', $track->currentPostOffice()->first()->llong)}}],
                        @endforeach
                ['{{$destination->name}}',{{preg_replace('/[^0-9.]+/', '', $destination->lat)}},{{preg_replace('/[^0-9.]+/', '', $destination->llong)}}]
        ];

        function initialize() {
            directionsDisplay = new google.maps.DirectionsRenderer();


            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: new google.maps.LatLng(-33.92, 151.25),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            directionsDisplay.setMap(map);
            var infowindow = new google.maps.InfoWindow();

            var marker, i;
            var request = {
                travelMode: google.maps.TravelMode.DRIVING
            };
            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
                if (i == 0) request.origin = marker.getPosition();
                else if (i == locations.length - 1) request.destination = marker.getPosition();
                else {
                    if (!request.waypoints) request.waypoints = [];
                    request.waypoints.push({
                        location: marker.getPosition(),
                        stopover: true
                    });
                }

            }
            directionsService.route(request, function(result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(result);
                }
            });
        }
        google.maps.event.addDomListener(window, "load", initialize);
        };
    </script>

@endsection