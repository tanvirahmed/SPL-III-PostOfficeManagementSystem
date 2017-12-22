<?php

namespace App\Http\Controllers;

use App\Models\Manager;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\In;
use League\Flysystem\Exception;
use App\Models\Branch;
class ManagerController extends Controller
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
if(Auth::user()->type!=0) {
return $this->throwUnauthorized();
}
//        dd( session()->get("flashmessage"));
//        session()->forget("flashmessage");
        $managers=Manager::where('type','>',0)->get();
        return view('pages.entity')->with('entities',$managers)->with('add','addManager')->with('edit','editManager')->with('delete','deleteManager')->with('partial','partials.managertable')->with('pagetitle','Branch Managers');;
    }
    public function addManager() {
        $data = (Input::all());
        $branches = Branch::leftjoin('manager','branch','=','branch.id')->where('manager',0);
        return view('crud.manager')->with('title',"Save Managers")->with('number',$data["number"])->with('action','add')->with('branches',$branches);
    }

    public function saveManager($title="Save Managers") {
        $data = (Input::all());
        $allokay= true;
        $insert=[];
        $action=$data["action"];

        $managers=$data["manager"];
//dd($managers["manager"]);
        foreach ($managers as $key=>$manager) {
            $manager["type"]=2;
            $insert[]=$manager;
            $manager =(object)$manager;
            $managers[$key]=$manager;
            $managers[$key]->errors=[];
            //dd();
            if(!is_numeric($manager->nid)) {
                $allokay=false;
                $managers[$key]->errors[]="Invalid National Id";
            }
            if(!is_numeric($manager->branch) || $manager->branch<=0) {
                $allokay=false;
                $managers[$key]->errors[]="Assign a branch";
            }
            if(strlen($manager->name)==0) {
                $allokay=false;
                $managers[$key]->errors[]="Must have a name";
            }
            if(strlen($manager->dob)>0) {

                $d = DateTime::createFromFormat("Y-m-d", $manager->dob);

                if($d && $d->format("Y-m-d" ) == $manager->dob) {
                } else {
                    $allokay=false;
                    $managers[$key]->errors[] = "Invalid Date";
                }
            } else {
                $allokay=false;
                $managers[$key]->errors[]="Enter a date";
            }
            if (filter_var($manager->email, FILTER_VALIDATE_EMAIL) === false) {
                $allokay = false;
                $managers[$key]->errors[] = "Enter a valid email";
            } else {
                if($manager->id == 0) {
                    $exsiting = Manager::where('email',$manager->email)->first();
                    if($exsiting!=null) {
                        $allokay = false;
                        $managers[$key]->errors[] = "Email already exists";
                    }
                } else {
                    $exsiting = Manager::where('id','!=',$manager->id)->where("email",$manager->email)->first();
                    if($exsiting!=null) {
                        $allokay = false;
                        $managers[$key]->errors[] = "Email already exists";
                    }
                }
            }

            if ($manager->id == 0) {
                if (strlen($manager->password) < 6) {
                    $allokay = false;
                    $managers[$key]->errors[] = "Password must be of at least 6 characters";
                }
            } else {
                if (isset($manager->reset) && $manager->reset == "on") {
                    if (strlen($manager->password) < 6) {
                        $allokay = false;
                        $managers[$key]->errors[] = "Password must be of at least 6 characters";
                    }
                } else {
                    try {
                        unset($insert[count($insert) - 1]["password"]);
                    } catch (\Exception $e) {}
                }
            }
            try {
                unset($insert[count($insert) - 1]["reset"]);
            } catch (\Exception $e) {}


        }
        //Session::flush();
        if(!$allokay) return view('crud.manager')->with('title',$title)->with('entities',$managers)->with('action',$action);
        foreach ($insert as $key=>$manager) {
            if(isset($insert[$key]["branch_title"])) unset($insert[$key]["branch_title"]);
            if(isset($insert[$key]["password"]))
            $insert[$key]["password"]= Hash::make($manager["password"]);
        }
        if($action=="add") {

            DB::table('users')->insert($insert);
            $this->setSuccess("Managers are aded");
        } else {
            foreach ($insert as $manager) {
                Manager::where('id',$manager["id"])->update($manager);
            }
            $this->setSuccess("Managers are updated");
        }
        return redirect()->route('managers');
    }
    public function editManager() {
        try {
            $ids = json_decode(Input::all()["ids"]);
            $managers = Manager::whereIn('id',$ids)->get();
            return view('crud.manager')->with('entities',$managers)->with('title','Edit Managers')->with('action','edit');
        } catch ( \Exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteManager() {
        try {
            $ids = json_decode(Input::all()["ids"]);
            if(!Manager::whereIn('id',$ids)->delete()) {
                throw  new Exception("Failed to delete");
            }
            $this->setSuccess("Deletion is successfull");
        } catch ( \Exception $e) {
            $this->setError($e->getMessage());

        }
        return redirect()->route('managers');
    }
    public function getAvailableBranches() {
        try {
            $data = Input::all();
            $ids = [];if(isset($data["ids"])) $ids=$data["ids"];
//            dd($data);
            $branches=Branch::selectRaw('branch.id,branch.name,branch.zilla,users.name as \'manager\'')->whereNotIn('branch.id',$ids)->leftjoin('users','users.branch','=','branch.id')->where('manager',null)->get();
            return response()->json(["branches"=>$branches]);
        } catch(\Exception $e) {
            return $this->AjaxError($e->getMessage());
        }
    }
}
