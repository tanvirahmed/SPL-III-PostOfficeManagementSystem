<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\In;
use League\Flysystem\Exception;

class BranchController extends Controller
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
    public function index()
    {
//        dd( session()->get("flashmessage"));
//        session()->forget("flashmessage");
        $branches=Branch::all();
        return view('pages.entity')->with('entities',$branches)->with('add','addBranch')->with('edit','editBranch')->with('delete','deleteBranch')->with('partial','partials.branchtable')->with('pagetitle','Branches');;
    }
    public function addBranch() {
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
        if(!$allokay) return view('crud.entity')->with('title',$title)->with('entities',$branches)->with('action',$action);
        if($action=="add") {
            DB::table('branch')->insert($insert);
            $this->setSuccess("Branches are aded");
        } else {
            foreach ($insert as $branch) {
                Branch::where('id',$branch["id"])->update($branch);
            }
            $this->setSuccess("Branches are updated");
        }
        return redirect()->route('branches');
    }
    public function editBranch() {
        try {
            $ids = json_decode(Input::all()["ids"]);
            $branches = Branch::whereIn('id',$ids)->get();
            return view('crud.entity')->with('entities',$branches)->with('title','Edit Branches')->with('action','edit');
        } catch ( \Exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteBranch() {
        try {
            $ids = json_decode(Input::all()["ids"]);
            if(!Branch::whereIn('id',$ids)->delete()) {
                throw  new Exception("Failed to delete");
            }
            $this->setSuccess("Branches are updated");
        } catch ( \Exception $e) {
            $this->setError($e->getMessage());

        }
        return redirect()->route('branches');
    }
    public function getBranches() {
        return response()->json(["branches"=>Branch::all()]);
    }
}
