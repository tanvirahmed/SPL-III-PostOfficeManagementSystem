<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;

class CustomController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $table;
    public $Model;
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function add() {
        $data = (Input::all());
        return view('crud.entity')->with('title',"Save Branches")->with('number',$data["number"])->with('action','add');
    }
    public function saveBranch($title="Save Branches") {
        $data = (Input::all());
        $allokay= true;
$insert=[];
        $action=$data["action"];

        $branches=$data["branch"];
//dd($branches["branch"]);
        foreach ($branches as $key=>$branch) {
            $insert[]=$branch;
            $branch =(object)$branch;
            $branches[$key]=$branch;
            $branches[$key]->errors=[];
            //dd();
            if(!is_numeric($branch->post_code)) {
                $allokay=false;
                $branches[$key]->errors[]="Invalid Post Code";
            }
            if(strlen($branch->name)==0) {
                $allokay=false;
                $branches[$key]->errors[]="Must have a name";
            }
            if(strlen($branch->zilla)==0) {
                $allokay=false;
                $branches[$key]->errors[]="Must have a zilla";
            }


        }
        //Session::flush();
        if(!$allokay) return view('crud.entity')->with('title',$title)->with('branches',$branches)->with('action',$action);
        if($action=="add") {
            DB::table('branch')->insert($insert);
            $this->setSuccess("Branches are aded");
        } else {
            foreach ($insert as $branch) {
                Branch::where('id',$branch["id"])->update($branch);
            }
            $this->setSuccess("Branches are updated");
        }
        return $this->index();
    }
    public function edit() {
        try {
            $ids = json_decode(Input::all()["ids"]);

            $models = $Model::whereIn('id',$ids)->get();
            return view('crud.entity')->with('branches',$models)->with('title','Edit Branches')->with('action','edit');
        } catch ( \Exception $e) {
            echo $e->getMessage();
        }
    }
}
