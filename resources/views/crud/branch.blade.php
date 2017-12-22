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
            <small>a set of beautiful icons</small>
        </h1>

    </section>

       <form method="post" action="{{route('saveBranch')}}" onsubmit="showLoading()" class="mt-20 " >
           @if(isset($branches))
{{--               {{dd($branches)}}--}}
               @foreach($branches as $i=>$branch)
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
                           <div class="col-xs-6">
                               <label>Name</label>
                               <input type="hidden"  name="branch[{{$i}}][id]"  data-n="id" value="{{$branch->id}}"  >
                               <input type="text" class="form-control"  name="branch[{{$i}}][name]" placeholder="Name" data-n="name"required value="{{$branch->name}}">
                           </div>
                           <div class="col-xs-3">
                               <label>Post Code</label>
                               <input type="text" class="form-control" placeholder="Post Code" name="branch[{{$i}}][post_code]" data-n="post_code" value="{{$branch->post_code}}" required>
                           </div>
                           <div class="col-xs-3">
                               <label>Zilla</label>
                               <input type="text" class="form-control" placeholder="Zilla" name="branch[{{$i}}][zilla]" data-n="zilla" required value="{{$branch->zilla}}">
                           </div>
                           @if(isset($branch->errors) && count($branch->errors)>0)
                           <div class="col-xs-12 mt-20">
                               <div class="alert alert-danger alert-dismissible">
                                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                   {{--<h4><i class="icon fa fa-ban"></i> Alert!</h4>--}}
                                   <ul>
                                       @foreach($branch->errors as $error)
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
                       <div class="col-xs-6">
                           <label>Name</label>
                           <input type="hidden" name="branch[{{$i}}][id]" data-n="id"  >
                           <input type="text" class="form-control"  name="branch[{{$i}}][name]" placeholder="Name" data-n="name"required>
                       </div>
                       <div class="col-xs-3">
                           <label>Post Code</label>
                           <input type="text" class="form-control" placeholder="Post Code" name="branch[{{$i}}][post_code]" data-n="post_code" required>
                       </div>
                       <div class="col-xs-3">
                           <label>Zilla</label>
                           <input type="text" class="form-control" placeholder="Zilla" name="branch[{{$i}}][zilla]" data-n="zilla" required >
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