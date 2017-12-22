<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Auth;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//
//        //die();
//        return view('pages.home');
//    }
public function settings (){

    return view('pages.settings')->with('user',Auth::user())->with('contentHeader','Settings');
}
    public function changePassword() {


        if(strlen(Input::get('newpassword'))<6) {
            return response('Password must be of more than 5 characters',400);
        }
        if(Input::get('newpassword')!=Input::get('confirmpassword')) {
            return response('Password is not confirmed',400);
        }
//        dd([Input::get('oldpassword'), Auth::user()->password]);
        if (Hash::check(Input::get('oldpassword'), Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->password =  Hash::make(Input::get('newpassword'));;
            if($user->save()) {
                return response()->json(["message"=>"Password Updated"]);

            }
        } else {
            return response('Password does not match',400);
        }

    }
    public function changeProfile() {



//        dd([Input::get('oldpassword'), Auth::user()->password]);

        if (Hash::check(Input::get('oldpassword'), Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->name =  (Input::get('name'));;
            $user->email=  (Input::get('email'));;
            $exsiting = User::where('id','!=',$user->id)->where("email",$user->email)->first();
            if($exsiting!=null) {
                return response('Email already exists',400);

            }
            if($user->save()) {
                return response()->json(["message"=>"Profile Updated"]);

            }
        } else {
            return response('Password does not match',400);
        }

    }
}
