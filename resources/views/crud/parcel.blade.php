@extends('layouts.admin')
<?php
$statuses =\Illuminate\Support\Facades\DB::table('parcel_status')->get();
?>
@section('header')
    <style>
        td.details {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <section class="content-header pl-1">
        <h1>
            {{$title}}
            {{--<small>a set of beautiful icons</small>--}}
        </h1>

    </section>

       <form method="post" action="{{route('saveParcel')}}" onsubmit="showLoading()" class="mt-20 " >
           @if(isset($type))
               <input type="hidden"  name="type" value="{{$type}}"   >
               @endif

           @if(isset($entities))
{{--               {{dd($parceles)}}--}}
               @foreach($entities as $i=>$parcel)
               <div class="box box-success col-md-4 entity-box f-l" >
                   <div class="box-header with-border">
                       <h3 class="box-title">{{$type==1?'Parcel':'Money Order'}}</h3>

                       <div class="box-tools pull-right">

                           <button type="button" class="btn btn-box-tool delete-entity" ><i class="fa fa-times"></i>
                           </button>
                       </div>
                   </div>
                   <div class="box-body">
                       <div class="row">

                           <div class="col-xs-3">
                               <label>Sender Name</label>
                               <input type="hidden"  name="parcel[{{$i}}][id]"  data-n="id"  value="{{$parcel->id}}" >
                               <input type="text" class="form-control"  name="parcel[{{$i}}][sender_name]" placeholder="Sender Name" data-n="sender_name" required value="{{$parcel->sender_name}}">
                           </div>
                           <div class="col-xs-3">
                               <label>Receiver Name</label>
                               <input type="text" class="form-control" placeholder="Receiver Name" name="parcel[{{$i}}][receiver_name]" data-n="receiver_name"  required value="{{$parcel->receiver_name}}">
                           </div>
                           <div class="col-xs-6">
                               <label>Receiver Address</label>
                               <input type="text" class="form-control" placeholder="Receiver Address" name="parcel[{{$i}}][receiver_address]" data-n="receiver_address" required value="{{$parcel->receiver_address}}" >
                           </div>
                       </div>
                       <div class="row mt-20">

                           <div class="col-xs-3 holder">
                               <label>Source Post Office</label>
                               <?php
                               $sourcePostOfficeTitle=isset($parcel->post_title_source)?$parcel->post_title_source:'';
                               if ($parcel instanceof \Illuminate\Database\Eloquent\Model) {
                                   $sourcePostOffice = $parcel->sourcePostOffice()->get()->first();
                                   if($sourcePostOffice!=null) {
                                       $sourcePostOfficeTitle = $sourcePostOffice->name;
                                   }
                               }?>
                               <input name="parcel[{{$i}}][post_title_source]" class="form-control post-office-title"  onclick="choosePostOffice(this)" placeholder="Choose Post Office" data-n="post_title_source" value="{{$sourcePostOfficeTitle}}"/>
                               {{--<input  class="form-control post-office-title"  name="post_title_source" onclick="choosePostOffice(this)" placeholder="Choose Post Office" value="{{$sourcePostOfficeTitle}}"/>--}}
                               <input class="post-office" style="height:0;width:0;pointer-events: none;opacity: 0;margin:auto"  name="parcel[{{$i}}][source_post_office]" data-n="source_post_office" required value="{{$parcel->source_post_office}}"/>
                           </div>
                           <div class="col-xs-3 holder">
                               <label>Destintation Post Office</label>
                               <?php
                               $destinationPostOfficeTitle=isset($parcel->post_title_destination)?$parcel->post_title_destination:'';
                               if ($parcel instanceof \Illuminate\Database\Eloquent\Model) {
                                   $destinationPostOffice = $parcel->destinationPostOffice()->get()->first();
                                   if($destinationPostOffice!=null) {
                                       $destinationPostOfficeTitle = $destinationPostOffice->name;
                                   }
                               }?>
                               <input name="parcel[{{$i}}][post_title_destination]" class="form-control post-office-title"  onclick="choosePostOffice(this)" placeholder="Choose Post Office" data-n="post_title_destination" value="{{$destinationPostOfficeTitle}}"/>
                               <input class="post-office" style="height:0;width:0;pointer-events: none;opacity: 0;margin:auto"  name="parcel[{{$i}}][destination_post_office]" data-n="destination_post_office" value="{{$parcel->destination_post_office}}" required/>
                           </div>
                           <div class="col-xs-2">
                               <label>
                               @if(isset($type) && $type==2)
                                   Amount
                               @else
                                   Weight
                               @endif
                               </label>

                               <input type="text" class="form-control numeric" name="parcel[{{$i}}][weight]"
                                      placeholder="Weight" data-n="weight" value="{{$parcel->weight}}" required>
                           </div>
                           <div class="col-xs-2">
                               <label>
                                   @if(isset($type) && $type==2)
                                       Cost
                                       @else
                                       Price
                                       @endif

                               </label>

                               <input type="text" class="form-control numeric" name="parcel[{{$i}}][price]"
                                      placeholder="Price" data-n="price" value="{{$parcel->price}}" required>
                           </div>
                           <div class="col-xs-2">
                               <label>Pin</label>

                               <input type="text" class="form-control" name="parcel[{{$i}}][pin]"
                                      placeholder="Pin" data-n="pin" required value="{{$parcel->pin}}"/>
                           </div>

                       </div>
                       <div class="row">
                           <div class="col-xs-3">
                               <label>Sender Mobile No</label>

                               <input type="text" class="form-control" name="parcel[{{$i}}][sender_phone]"
                                      placeholder="" data-n="sender_phone" required value="{{$parcel->sender_phone}}"/>
                           </div>
                           <div class="col-xs-3">
                               <label>Receiver Mobile No</label>

                               <input type="text" class="form-control" name="parcel[{{$i}}][receiver_phone]"
                                      placeholder="" data-n="receiver_phone" required value="{{$parcel->receiver_phone}}"/>
                           </div>
                       </div>

                           @if(isset($parcel->errors) && count($parcel->errors)>0)
                               <div class="row">
                           <div class="col-xs-12 mt-20">
                               <div class="alert alert-danger alert-dismissible">
                                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                   {{--<h4><i class="icon fa fa-ban"></i> Alert!</h4>--}}
                                   <ul>
                                       @foreach($parcel->errors as $error)
                                           <li>{{$error}}</li>
                                       @endforeach
                                   </ul>
                               </div>

                           </div>
                               </div>
                               @endif

                   </div>

               </div>
               @endforeach
               @else
@for($i =0 ; $i < $number ; $i++)
           <div class="box box-success col-md-4 entity-box f-l" >
               <div class="box-header with-border">
                   <h3 class="box-title">{{$type==1?'Parcel':'Money Order'}}</h3>

                   <div class="box-tools pull-right">

                       <button type="button" class="btn btn-box-tool delete-entity" ><i class="fa fa-times"></i>
                       </button>
                   </div>
               </div>
               <div class="box-body">
                   <div class="row">

                       <div class="col-xs-3">
                           <label>Sender Name</label>
                           <input type="hidden"  name="parcel[{{$i}}][id]"  data-n="id"   >

                           <input type="text" class="form-control"  name="parcel[{{$i}}][sender_name]" placeholder="Sender Name" data-n="sender_name" required>
                       </div>
                       <div class="col-xs-3">
                           <label>Receiver Name</label>
                           <input type="text" class="form-control" placeholder="Receiver Name" name="parcel[{{$i}}][receiver_name]" data-n="receiver_name"  required>
                       </div>
                       <div class="col-xs-6">
                           <label>Receiver Address</label>
                           <input type="text" class="form-control" placeholder="Receiver Address" name="parcel[{{$i}}][receiver_address]" data-n="receiver_address" required >
                       </div>
                   </div>
                   <div class="row mt-20">

                       <div class="col-xs-3 holder">
                           <label>Source Post Office</label>
                           <input name="parcel[{{$i}}][post_title_source]" class="form-control post-office-title"  onclick="choosePostOffice(this)" placeholder="Choose Post Office" data-n="post_title_source"/>
                           <input class="post-office" style="height:0;width:0;pointer-events: none;opacity: 0;margin:auto"  name="parcel[{{$i}}][source_post_office]" data-n="source_post_office" required/>
                       </div>
                       <div class="col-xs-3 holder">
                           <label>Destination Post Office</label>
                           <input  name="parcel[{{$i}}][post_title_destination]" class="form-control post-office-title"  onclick="choosePostOffice(this)" placeholder="Choose Post Office" data-n="post_title_destination"/>
                           <input class="post-office" style="height:0;width:0;pointer-events: none;opacity: 0;margin:auto"  name="parcel[{{$i}}][destination_post_office]" data-n="destination_post_office" required/>
                       </div>
                       <div class="col-xs-2">
                           <label>
                               @if(isset($type) && $type==2)
                                   Amount
                               @else
                                   Weight
                               @endif
                           </label>

                           <input type="text" class="form-control numeric" name="parcel[{{$i}}][weight]"
                                  placeholder="" data-n="weight" required>
                       </div>
                       <div class="col-xs-2">
                           <label>
                               @if(isset($type) && $type==2)
                                   Cost
                               @else
                                   Price
                               @endif

                           </label>

                           <input type="text" class="form-control numeric" name="parcel[{{$i}}][price]"
                                  placeholder="" data-n="price" required>
                       </div>
                       <div class="col-xs-2">
                       <label>Pin</label>

                           <input type="text" class="form-control" name="parcel[{{$i}}][pin]"
                                  placeholder="Pin" data-n="pin" required/>
                       </div>

                       {{--<div class="col-xs-2">--}}
                           {{--<label>Status</label>--}}

                           {{--<select type="text" class="form-control" name="parcel[{{$i}}][status]"--}}
                                   {{--data-n="status" required>--}}
                               {{--<option value="">Choose Status</option>--}}
                               {{--@foreach($statuses as $status)--}}

                                   {{--<option value="{{$status->id}}">{{$status->title}}</option>--}}
                                   {{--@endforeach--}}
                           {{--</select>--}}
                       {{--</div>--}}
                   </div>
                   <div class="row ">
                       <div class="col-xs-3">
                           <label>Sender Mobile No</label>

                           <input type="text" class="form-control" name="parcel[{{$i}}][sender_phone]"
                                  placeholder="" data-n="sender_phone" required/>
                       </div>
                       <div class="col-xs-3">
                           <label>Receiver Mobile No</label>

                           <input type="text" class="form-control" name="parcel[{{$i}}][receiver_phone]"
                                  placeholder="" data-n="receiver_phone" required/>
                       </div>
                   </div>
               </div>

           </div>

@endfor
           @endif
    <div class="t-r"><button class="mdl-button mdl-button--raised mdl-color1" type="submit">Save</button></div>
           <input name="action" value="{{$action}}" type="hidden">
       </form>
       <!-- /.box-body -->

@endsection
@section('footer-script')
    <script id="branch-template" type="text/x-jquery-tmpl">

                  <li onclick="setPostOffice(${id},'${name}',this)"><a>${name},${zilla}</a></li>


    </script>
<script>
    (function($){
        $('.numeric').autoNumeric({dGroup:4});
        $('.post-office-title').focus(function(){choosePostOffice(this)});
        $(".delete-entity").click(function () {
            $(this).parents(".entity-box").remove();
            $(".entity-box").each(function () {
                var i = $(this).index();
                $(this).find('input,select,textarea').each(function () {
                    this.name='parcel['+i+']'+'['+this.getAttribute('data-n')+']';
                })
            })
        });
        $(".date-picker").datepicker({dateFormat:'yy-mm-dd'});

    })(jQuery);
    function setPostOffice(id,title,option) {
        if(option) {
            $(option).siblings('li').removeClass('active');
            $(option).addClass('active');
        }
        var postoffice = window.currentparcel.find('.post-office').first();
        postoffice.val(id);
        postoffice.siblings('input.post-office-title').val(title);
    }
    function choosePostOffice(element){
        window.currentparcel=$(element).parents('.holder').first();
        if(window.branches) {
            var ul=$('<ul class="dropdown-menu" style="display:block;position:relative;max-height: 200px;overflow-y:scroll" />').append($("#branch-template").tmpl(window.branches));
            var a =showDialog({title:'Assign Post Office',text:$('<div/>').append(ul).html()
                        ,positive:{title:'Assign'}
                        ,negative:{title:'Cancel',onClick:function(){
                            setPostOffice(null,'Assign Post Office');
                        }}
                    }

            );
            return;
        }
        http({url:'{{route('getPostOffice')}}',method:'get'}).setElement(element).done(function (data){
            window.branches = data.branches;
            var ul=$('<ul class="dropdown-menu" style="display:block;position:relative;max-height: 200px;overflow-y:scroll" />').append($("#branch-template").tmpl(data.branches));
            var a =showDialog({title:'Assign Post Office',text:$('<div/>').append(ul).html()
            ,positive:{title:'Assign'}
            ,negative:{title:'Cancel',onClick:function(){
                    setPostOffice(null,'Assign Post Office');
                        }}
            }

            );


        }).preExecute(function() {showLoading()}).always(function(){
            hideLoading();
        }).execute();
    }
</script>
    <?php
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    ?>
@endsection