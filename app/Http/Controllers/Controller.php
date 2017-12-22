<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use View;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function setSuccess($message){
//        View::composer('layouts.admin', function($view) use($message)
//        {
//            $view->with('sessionMessage',(object)["status"=>"ok","message"=>$message]);
//        });
       session()->flash('flashmessage', (object)["status"=>"ok","message"=>$message]);
    }
    public function setError($message){
//        View::composer('layouts.admin', function($view) use($message)
//        {
//            $view->with('sessionMessage',(object)["status"=>"not_ok","message"=>$message]);
//        });
        session()->flash('flashmessage', (object)["status"=>"not_ok","message"=>$message]);
    }
    public function AjaxError($message="Error",$code=500) {
        return response()->json(["message"=>$message],$code);
    }
    public function throwUnauthorized() {
        return view('pages.unauthorized');

}
}
