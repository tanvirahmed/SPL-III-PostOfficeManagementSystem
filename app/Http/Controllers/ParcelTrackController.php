<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use League\Flysystem\Exception;

class ParcelTrackController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parceltrack');
    }
    public function track()
    {
        try {
            $pin = Input::all()['pin'];
            $trackid = Input::all()['tracking_id'];
//            dd($trackid);
            $parcel = Parcel::where('pin',$pin)->where  ('tracking_id',$trackid)->first();
if($parcel==null) {
    throw new Exception();
}
            $tracks = $parcel->tracks()->get();
            if (count($tracks) == 0) {
                $this->setError("No tracking points are found");
                redirect()->route('home');
            }

            return view('showinmap')->with('parcel', $parcel)->with('tracks', $tracks);
        } catch (\Exception $e) {
            return view('notfound');
        }
    }
}
