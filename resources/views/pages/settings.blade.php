@extends('layouts.admin')

@section('header')
    <style>
        td.details {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
<div class="col-md-6">
    <div class="box box-primary mt-20 " style="width: 400px">

        <div class="box-header with-border">
            <h3 class="box-title">Profile</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div role="form" id="profileform" >
            <div class="box-body">

                <div class="form-group">
                    <label >Name</label>
                    <input type="text" class="form-control" name="name"  placeholder="Name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label >Email</label>
                    <input type="email" class="form-control"  placeholder="Email" name="email" value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control" name="oldpassword"  placeholder="Current Password">
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="save-user">Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="box box-primary mt-20 col-md-6" style="width: 400px">
        <div class="box-header with-border">
            <h3 class="box-title">Change Password</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div role="form" id="passwordform" >
            <div class="box-body">

                <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control" name="oldpassword"  placeholder="Old Password">
                </div>
                <div class="form-group">
                    <label >New Password</label>
                    <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label >Confirm Passoword</label>
                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password">
                </div>


            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="save-password">Submit</button>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('footer-script')

    <script>
        httpSetup({
            preCallback: function () {
                showLoading();
            },
            failCallback:function (a,b,c) {
                $.toast({title:'Error'});
            }
            ,alwaysCallback: function () {
                hideLoading();
            }
        });
$(function () {
    //ready
    $("#save-password").click(function () {
                var data=function (){
                    var b={valid:true};

                    $("#passwordform input").each(function () {
                        b[this.name]=this.value;
                        if(this.value.length==0) b.valid=false;
                    })
                    return b;
                }();
                if(!data.valid) {
                    $.toast({title:"All inputs must not be empty and alteast of 6 characters"});
                    return;
                }
                if(data.confirmpassword!=data.newpassword) {
                    $.toast({title:"Password is not confirmed"});
                    return;
                }

                showLoading();

                http({url:'{{route('changePassowrd')}}'
                    ,method:'post'
                    ,data:data
                }).done(function (data) {
                    $("#passwordform input").val('');
                    $.toast({title:data.message});
                }).fail(function(a,b,c) {
                    $.toast({title:a.responseText});

                }).always(function () {
                    hideLoading();
                }).execute();
            });
    $("#save-user").click(function () {
        var data=function (){
            var b={valid:true};

            $("#profileform input").each(function () {
                b[this.name]=this.value;
                if(this.value.length==0) b.valid=false;
            })
            return b;
        }();
        if(!data.valid) {
            $.toast({title:"Inputs must not be empty"});
            return;
        }


        showLoading();

        http({url:'{{route('changeProfile')}}'
            ,method:'post'
            ,data:data
        }).done(function (data) {
//            $("#profileform input").val('');
            $.toast({title:data.message});
        }).fail(function(a,b,c) {
            $.toast({title:a.responseText});

        }).always(function () {
            hideLoading();
        }).execute();
    });

})  ;
    </script>
@endsection