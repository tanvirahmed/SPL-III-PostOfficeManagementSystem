@extends('layouts.admin')

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

       <form method="post" action="{{route('saveBranch')}}" onsubmit="showLoading()" class="mt-20 " >
           @if(isset($entities))
{{--               {{dd($branches)}}--}}
               @foreach($entities as $i=>$entity)
               <div class="box box-success col-md-4 entity-box f-l" >
                   <div class="box-header with-border">
                       <h3 class="box-title">Branch</h3>

                       <div class="box-tools pull-right">

                           <button type="button" class="btn btn-box-tool delete-entity" ><i class="fa fa-times"></i>
                           </button>
                       </div>
                   </div>
                   <div class="box-body">
                       <div class="row">
                           <div class="col-xs-3">
                               <label>Name</label>
                               <input type="hidden"  name="branch[{{$i}}][id]"  data-n="id" value="{{$entity->id}}"  >
                               <input type="text" class="form-control"  name="branch[{{$i}}][name]" placeholder="Name" data-n="name"required value="{{$entity->name}}">
                           </div>
                           <div class="col-xs-1">
                               <label>P.Code</label>
                               <input type="text" class="form-control" placeholder="Post Code" name="branch[{{$i}}][post_code]" data-n="post_code" value="{{$entity->post_code}}" required>
                           </div>
                           <div class="col-xs-2">
                               <label>Zilla</label>
                               <input type="text" class="form-control" placeholder="Zilla" name="branch[{{$i}}][zilla]" data-n="zilla" required value="{{$entity->zilla}}">
                           </div>
                           <div class="col-xs-2">
                               <label>Upzilla</label>
                               <input type="text" class="form-control" placeholder="Upzilla" name="branch[{{$i}}][Upzilla]" data-n="district" required value="{{$entity->Upzilla}}">
                           </div>
                           <div class="col-xs-2">
                               <label>Latitude</label>
                               <input type="text" class="form-control" placeholder="Latitude" name="branch[{{$i}}][lat]" data-n="lat" required value="{{$entity->lat}}">
                           </div>
                           <div class="col-xs-2">
                               <label>Longitude</label>
                               <input type="text" class="form-control" placeholder="Longitude" name="branch[{{$i}}][llong]" data-n="llong" required value="{{$entity->llong}}">
                           </div>

                           @if(isset($entity->errors) && count($entity->errors)>0)
                           <div class="col-xs-12 mt-20">
                               <div class="alert alert-danger alert-dismissible">
                                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                   {{--<h4><i class="icon fa fa-ban"></i> Alert!</h4>--}}
                                   <ul>
                                       @foreach($entity->errors as $error)
                                           <li>{{$error}}</li>
                                       @endforeach
                                   </ul>
                               </div>

                           </div>
                               @endif
                       </div>
                   </div>

               </div>
               @endforeach
               @else
@for($i =0 ; $i < $number ; $i++)
           <div class="box box-success col-md-4 entity-box f-l" >
               <div class="box-header with-border">
                   <h3 class="box-title">Branch</h3>

                   <div class="box-tools pull-right">

                       <button type="button" class="btn btn-box-tool delete-entity" ><i class="fa fa-times"></i>
                       </button>
                   </div>
               </div>
               <div class="box-body">
                   <div class="row">
                       <div class="col-xs-3">
                           <label>Name</label>
                           <input type="hidden" name="branch[{{$i}}][id]" data-n="id"  >
                           <input type="text" class="form-control"  name="branch[{{$i}}][name]" placeholder="Name" data-n="name" required/>
                       </div>
                       <div class="col-xs-1">
                           <label>P.Code</label>
                           <input type="text" class="form-control" placeholder="Post Code" name="branch[{{$i}}][post_code]" data-n="post_code" required/>
                       </div>
                       <div class="col-xs-2">
                           <label>Zilla</label>
                           <input type="text" class="form-control" placeholder="Zilla" name="branch[{{$i}}][zilla]" data-n="zilla" required />
                       </div>
                       <div class="col-xs-2">
                           <label>Upzilla</label>
                           <input type="text" class="form-control" placeholder="Upzilla" name="branch[{{$i}}][Upzilla]" data-n="district" required />
                       </div>
                       <div class="col-xs-2">
                           <label>Latitude</label>
                           <input type="text" class="form-control" placeholder="Latitude" name="branch[{{$i}}][lat]" data-n="lat" required />
                       </div>
                       <div class="col-xs-2">
                           <label>Longitude</label>
                           <input type="text" class="form-control" placeholder="Longitude" name="branch[{{$i}}][llong]" data-n="llong" required />
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
<script>
    (function($){
        $(".delete-entity").click(function () {
            $(this).parents(".entity-box").remove();
            $(".entity-box").each(function () {
                var i = $(this).index();
                $(this).find('input,select,textarea').each(function () {
                    this.name='branch['+i+']'+'['+this.getAttribute('data-n')+']';
                })
            })
        })
    })(jQuery);
</script>
@endsection