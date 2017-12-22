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

    <form method="post" action="{{route('saveManager')}}" onsubmit="showLoading()" class="mt-20 ">
        @if(isset($entities))
            {{--               {{dd($manageres)}}--}}
            @foreach($entities as $i=>$manager)
                <div class="box box-success col-md-4 entity-box f-l">
                    <div class="box-header with-border">
                        <h3 class="box-title">Manager</h3>

                        <div class="box-tools pull-right">

                            <button type="button" class="btn btn-box-tool delete-entity"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <label>Name</label>
                                <input type="hidden" name="manager[{{$i}}][id]" data-n="id" value="{{$manager->id}}">
                                <input type="text" class="form-control" name="manager[{{$i}}][name]" placeholder="Name"
                                       data-n="name" required value="{{$manager->name}}">
                            </div>
                            <div class="col-xs-2">
                                <label>Date Of Birth</label>
                                <input type="text" class="form-control date-picker" placeholder="Date of birth"
                                       name="manager[{{$i}}][dob]" data-n="dob" value="{{$manager->dob}}" required>
                            </div>
                            <div class="col-xs-3">
                                <label>National ID</label>
                                <input type="text" class="form-control" placeholder="NID" name="manager[{{$i}}][nid]"
                                       data-n="nid" required value="{{$manager->nid}}">
                            </div>
                            <div class="col-xs-3">
                                <label>Branch</label>
                                <?php

                                $branch_title="";
                                    if(isset($manager->branch_title))$branch_title=$manager->branch_title;
                                    else {
                                        $assignedBranch = \App\Models\Branch::find($manager->branch);
                                        if($assignedBranch!=null ) $branch_title=$assignedBranch->name;
                                    }


                                ?>
                                <input class="form-control branch-title" onclick="chooseBranch(this)" name="manager[{{$i}}][branch_title]" data-n="branch_title"  value="{{$branch_title}}"readonly/>

                                    {{--{{$manager->assignedBranch()->name}}--}}
                                {{--</input>--}}
                                <input type="hidden" class="form-control" placeholder="NID"
                                       name="manager[{{$i}}][branch]" data-n="branch" required
                                       value="{{$manager->branch}}">
                            </div>
                        </div>
                        <div class="row mt-10">
                            <div class="col-xs-4">
                                <label>Email</label>

                                <input type="email" class="form-control" name="manager[{{$i}}][email]"
                                       placeholder="Email" value="{{$manager->email}}"
                                       data-n="email" required>
                            </div>
                            <div class="col-xs-4">
                                @if($manager->id!=0)
                                    <input name="manager[{{$i}}][reset]" data-n="reset" type="checkbox" onclick="var a =$(this).siblings('input');if(a.attr('readonly')) {a.removeAttr('readonly');a.attr('required',true);} else {a.attr('readonly',true);a.removeAttr('required')}"/> <label> Reset Password</label>


                                    <input type="text" class="form-control password" name="manager[{{$i}}][password]"
                                           placeholder="Password" data-n="password" required value="" readonly>
                                @else
                                    <label>Password</label>


                                    <input type="text" class="form-control password" name="manager[{{$i}}][password]"
                                           placeholder="Password" data-n="password" required value="" >
                                @endif
                            </div>
                        </div>

                        @if(isset($manager->errors) && count($manager->errors)>0)
                            <div class="row">
                                <div class="col-xs-12 mt-20">
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                        </button>
                                        {{--<h4><i class="icon fa fa-ban"></i> Alert!</h4>--}}
                                        <ul>
                                            @foreach($manager->errors as $error)
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
                <div class="box box-success col-md-4 entity-box f-l">
                    <div class="box-header with-border">
                        <h3 class="box-title">Branch</h3>

                        <div class="box-tools pull-right">

                            <button type="button" class="btn btn-box-tool delete-entity"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <label>Name</label>
                                <input type="hidden" name="manager[{{$i}}][id]" data-n="id">
                                <input type="text" class="form-control" name="manager[{{$i}}][name]" placeholder="Name"
                                       data-n="name" required>
                            </div>
                            <div class="col-xs-2">
                                <label>Date Of Birth</label>
                                <input type="text" class="form-control date-picker" placeholder="Date of birth"
                                       name="manager[{{$i}}][dob]" data-n="dob" required>
                            </div>
                            <div class="col-xs-3">
                                <label>National ID</label>
                                <input type="text" class="form-control" placeholder="NID" name="manager[{{$i}}][nid]"
                                       data-n="nid" required>
                            </div>
                            <div class="col-xs-3">
                                <label>Branch</label>
                                <input class="form-control branch-title" onclick="chooseBranch(this)" name="manager[{{$i}}][branch_title]" data-n="branch_title"  value=""readonly/>
                                <input style="height:0;width:0;pointer-events: none;opacity: 0;margin:auto"
                                       name="manager[{{$i}}][branch]" data-n="branch" required/>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <label>Email</label>

                                <input type="email" class="form-control" name="manager[{{$i}}][email]"
                                       placeholder="Email"
                                       data-n="email" required/>
                            </div>
                            <div class="col-xs-4">
                                <label>Password</label>

                                <input type="text" class="form-control" name="manager[{{$i}}][password]"
                                       value="{{generateRandomString()}}"
                                       placeholder="Password" data-n="password" required/>
                            </div>
                        </div>
                    </div>

                </div>




            @endfor
        @endif
        <div class="t-r">
            <button class="mdl-button mdl-button--raised mdl-color1" type="submit">Save</button>
        </div>
        <input name="action" value="{{$action}}" type="hidden">
    </form>
    <!-- /.box-body -->

@endsection
@section('footer-script')
    <script id="branch-template" type="text/x-jquery-tmpl">

                  <li onclick="setBranch(${id},'${name}',this)"><a>${name},${zilla}</a></li>



    </script>
    <script>
        (function ($) {
            $(".delete-entity").click(function () {
                $(this).parents(".entity-box").remove();
                $(".entity-box").each(function () {
                    var i = $(this).index();
                    $(this).find('input,select,textarea').each(function () {
                        this.name = 'manager[' + i + ']' + '[' + this.getAttribute('data-n') + ']';
                    })
                })
            });
            $(".date-picker").datepicker({dateFormat: 'yy-mm-dd'});

        })(jQuery);
        function setBranch(id, title,element) {
            window.branch = {id:id,title:title};
            $(element).siblings("li").removeClass("active");
            $(element).addClass("active");

        }
        function chooseBranch(element) {
            window.currentmanager = $(element).parents('.box').first();
            var ids = [];
            $('[data-n="branch"]').each(function () {
                if (this.value.length > 0 && !isNaN(this.value))
                    ids[ids.length] = this.value;
            })
            http({
                url: '{{route('branchForManager')}}',
                method: 'post',
                data: {ids: ids}
            }).setElement(element).done(function (data) {
                var ul = $('<ul class="dropdown-menu" style="display:block;position:relative;max-height: 200px;overflow-y:scroll" />').append($("#branch-template").tmpl(data.branches));
                var a = showDialog({
                            title: 'Assign branch', text: $('<div/>').append(ul).html()
                            , positive: {title: 'Assign',onClick:function () {
                        var branch = window.currentmanager.find('[data-n="branch"]').first();
                        if(!window.branch) {
                            $.toast({title:'Select a branch'});
                            return false;
                        }
                        branch.val(window.branch.id);
                        branch.siblings('.branch-title').val(window.branch.title);
                    }}
                            , negative: {
                                title: 'Cancel', onClick: function () {
                                    setBranch(null, 'Assign Branch');
                                }
                            }
                        }
                );


            }).preExecute(function () {
                showLoading()
            }).always(function () {
                hideLoading();
            }).execute();
        }
    </script>
    <?php
    function generateRandomString($length = 10)
    {
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