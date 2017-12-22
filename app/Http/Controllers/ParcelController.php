<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Parcel;
use App\Models\Tracks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\In;
use League\Flysystem\Exception;
use Symfony\Component\Console\Tests\Input\InputTest;
use App\SMS\SMSManager;

class ParcelController extends Controller
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
        $parcels=[];
        $user =  Auth::user();;


        $mybrunch =null;

        if($user->type==0)
        $parcels=Parcel::selectRaw('parcel.*,t1.name as current_post_office_title,t2.name as destination_post_office_title,t3.name as source_post_office_title')->leftjoin('branch as t1',DB::raw('t1.id'),'=',DB::raw('parcel.current_post_office'))->leftjoin('branch as t2',DB::raw('t2.id'),'=',DB::raw('parcel.destination_post_office'))->leftjoin('branch as t3',DB::raw('t3.id'),'=',DB::raw('parcel.source_post_office'))->where('type',1)->get();
            else {

                $parcels = Parcel::selectRaw('parcel.*,t1.name as current_post_office_title,t2.name as destination_post_office_title,t3.name as source_post_office_title')->leftjoin('branch as t1', DB::raw('t1.id'), '=', DB::raw('parcel.current_post_office'))->leftjoin('branch as t2', DB::raw('t2.id'), '=', DB::raw('parcel.destination_post_office'))->leftjoin('branch as t3', DB::raw('t3.id'), '=', DB::raw('parcel.source_post_office'))->where(function ($query) use($user){
                    $query->where('next_post_office', $user->branch)->orWhere('source_post_office', $user->branch)->orWhere('current_post_office', $user->branch);
                })->where('type', 1)->get();
        }

        return view('pages.entity')->with('entities',$parcels)->with('add','addParcel')->with('edit','editParcel')->with('delete','deleteParcel')->with('partial','partials.parceltable')->with('pagetitle','Parcels')->with('type',1);
    }
public function moneyOrders()
    {
        $parcels=[];
        $user =  Auth::user();;

        $mybrunch =null;
        if($user->type==0)
            $parcels=Parcel::selectRaw('parcel.*,t1.name as current_post_office_title,t2.name as destination_post_office_title,t3.name as source_post_office_title')->leftjoin('branch as t1',DB::raw('t1.id'),'=',DB::raw('parcel.current_post_office'))->leftjoin('branch as t2',DB::raw('t2.id'),'=',DB::raw('parcel.destination_post_office'))->leftjoin('branch as t3',DB::raw('t3.id'),'=',DB::raw('parcel.source_post_office'))->where('type',2)->get();
        else {

            $parcels=Parcel::selectRaw('parcel.*,t1.name as current_post_office_title,t2.name as destination_post_office_title,t3.name as source_post_office_title')->leftjoin('branch as t1',DB::raw('t1.id'),'=',DB::raw('parcel.current_post_office'))->leftjoin('branch as t2',DB::raw('t2.id'),'=',DB::raw('parcel.destination_post_office'))->leftjoin('branch as t3',DB::raw('t3.id'),'=',DB::raw('parcel.source_post_office'))->where(function ($query) use($user){
                $query->where('next_post_office',$user->branch)->orWhere('source_post_office',$user->branch)->orWhere('current_post_office',$user->branch);
            })->where('type',2)->get();
        }

        return view('pages.entity')->with('entities',$parcels)->with('add','addMoneyOrder')->with('edit','editMoneyOrder')->with('delete','deleteParcel')->with('partial','partials.parceltable')->with('pagetitle','Money Orders')->with('type',2);;
    }
    public function addParcel($type=1,$title="Save Parcels") {
        $data = (Input::all());
        return view('crud.parcel')->with('title',$title)->with('number',$data["number"])->with('action','add')->with('type',$type);
    }
    public function addMoneyOrder() {
        return $this->addParcel(2,"Save Money Order");
    }
    public function saveMoneyOrder() {
        return $this->saveParcel("Save MoneyOrder");
    }
    public function editMoneyOrder() {
        return $this->editParcel("Save MoneyOrder");
    }
    public function saveParcel($title="Save Parcels") {
        $data = (Input::all());
//        dd($data);
        $allokay= true;
$insert=[];
        $type=1;
        if(isset($data["type"]) ) {
            $type=$data["type"];
        }
        $action=$data["action"];

        $parcels=$data["parcel"];
//dd($parcels["parcel"]);
        $trackOffset = 1;
        $lastParcel = Parcel::orderby('id','desc')->first();
        if($lastParcel!=null) $trackOffset=$lastParcel->id+1;

        foreach ($parcels as $key=>$parcel) {
            $parcel["tracking_id"]=($trackOffset++).$this->generateRandomString(4);
            $parcel["type"]=$type;
            $parcel["created_by"]=Auth::user()->id;
            $insert[]=$parcel;
            $parcel =(object)$parcel;
            $parcels[$key]=$parcel;
            $parcels[$key]->errors=[];
            //dd();
            if(!is_numeric($parcel->weight)) {
                $allokay=false;
                $parcels[$key]->errors[]="Invalid weight";
            }
            if(!is_numeric($parcel->price)) {
                $allokay=false;
                $parcels[$key]->errors[]="Invalid price";
            }


        }
        //Session::flush();

        if(!$allokay) return view('crud.parcel')->with('title',$title)->with('entities',$parcels)->with('action',$action)->with('type',$type);
        foreach ($insert as $key=>$parcel) {

            unset($insert[$key]["post_title_source"]);
            unset($insert[$key]["post_title_destination"]);
        }
        if($action=="add") {

            DB::table('parcel')->insert($insert);

            try {
              foreach ($parcels as $key=>$parcel) {
                  $sms = new SMSManager();
                  $body = "Tracking Id: ". $insert[$key]["tracking_id"]. "Pin: ".$insert[$key]["pin"];
                  $sms->sendSMS($insert[$key]["sender_phone"], $body);
                  $sms->sendSMS($insert[$key]["receiver_phone"], $body);    
              }
            }
            catch (\Exception $e) {
                //return $e->getMessage();
            }

            $this->setSuccess("Parcels are added");
        } else {
//            dd($insert);
            foreach ($insert as $parcel) {



                Parcel::where('id',$parcel["id"])->update($parcel);
            }
            $this->setSuccess("Parcels are updated");
        }
        if($type==1)
        return redirect()->route('parcels');
        else return redirect()->route('moneyOrders');
    }
    public function editParcel($title="Edit Parcels") {
//        dd(Input::all());
        try {
            $ids = json_decode(Input::all()["ids"]);
            $type=Input::all()["type"];
            $parcels = Parcel::whereIn('id',$ids)->get();
//            dd($parcels );
            return view('crud.parcel')->with('entities',$parcels)->with('title',$title)->with('action','edit')->with('type',$type);
        } catch ( \Exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteParcel() {
        try {
            $ids = json_decode(Input::all()["ids"]);
            if(!Parcel::whereIn('id',$ids)->delete()) {
                throw  new Exception("Failed to delete");
            }
            $this->setSuccess("Parcels are updated");
        } catch ( \Exception $e) {
            $this->setError($e->getMessage());

        }
        return redirect()->route('parcels');
    }
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function details($id=0) {
        if($id==0) return redirect()->route('parcels');
        $parcel = Parcel::find($id);
        $myBranch = Branch::find(Auth::user()->branch);
//dd($myBranch);
        $tracks = $parcel->tracks()->get();
        return view('pages.parcel')->with('parcel',$parcel)->with('tracks',$tracks)->with('branch',$myBranch);
    }
    public function addTrack() {
        $track = (Input::all());
//        dd($track);
        $user = Auth::user();
        $parcel=Parcel::find($track["parcel"]);
        if($user->branch==$parcel->destination_post_office) {
        
            $desTrack = Tracks::where("current",$user->branch)->where("parcel",$parcel->id)->first();
            if($desTrack !=null) {
                $desTrack->status=$track["status"];
                $desTrack->save();
                return response()->json(['update'=>true,
                    'track'=>[
                        'current'=>$desTrack->currentPostOffice()->first()->name,
                        'next'=>"Destination",
                        'status'=>$desTrack->statusObject()->first()->title,
                        'id'=>$desTrack->id,
                    ]]);    
            }

        }

        $track["current"]=$user->branch;
        $newTrack = new Tracks($track);

        $newTrack->save();
         $lastTrack=Tracks::where("parcel",$track["parcel"])->orderby('id','desc')->first();

        if($lastTrack!=null) {

            if($parcel!=null) {
                $parcel->current_post_office=$lastTrack->current;
                $parcel->next_post_office=$lastTrack->next;
                $parcel->status=$lastTrack->status;
                $parcel->save();
            }
        } else {
//            if($parcel!=null) {
//                $parcel->current_post_office=$lastTrack->current;
//                $parcel->status=3;
//                $parcel->save();
//            }
        }


        return response()->json(['update'=>false,
            'track'=>[
                'current'=>$newTrack->currentPostOffice()->first()->name,
                'next'=>$newTrack->nextPostOffice()->first()->name,
                'status'=>$newTrack->statusObject()->first()->title,
                'id'=>$newTrack->id,
        ]]);
    }
    public function deleteTrack() {
        $ids = Input::all()["ids"];
        foreach ($ids as $id) {

            $lastTrack=Tracks::find($id);
            $parcel=Parcel::find($lastTrack->parcel);
            if($lastTrack!=null) {

                if($parcel!=null) {
                    $parcel->current_post_office=$lastTrack->current;
                    $parcel->status=$lastTrack->status;
                    $parcel->save();
                }
            } else {
                if($parcel!=null) {
                    $parcel->current_post_office=$lastTrack->current;
                    $parcel->status=3;
                    $parcel->save();
                }
            }
            $lastTrack->delete();
        }

    }
    public function showInMap() {
        $parcel=Input::all('parcel');
        $parcel=Parcel::find($parcel)->first();
//        dd($parcel);
        $tracks = $parcel->tracks()->get();
        if(count($tracks)==0) {
            $this->setError("No tracking points are found");
            redirect()->route('home');
        }
//        dd($tracks);
return view('pages.showinmap')->with('parcel',$parcel)->with('tracks',$tracks);
    }
}
