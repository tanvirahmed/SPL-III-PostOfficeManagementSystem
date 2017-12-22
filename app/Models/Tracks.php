<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Tracks extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tracks';


    protected $fillable = [
        'parcel','status','next','destination','current','type',
    ];
    public function parcel()
    {
        return $this->belongsTo('App\Models\Parcel','id','parcel');
    }
    public function currentPostOffice() {
        return $this->hasOne('App\Models\Branch','id','current');
    }
    public function nextPostOffice() {
        return $this->hasOne('App\Models\Branch','id','next');
    }
    public function destinationPostOffice() {
        return $this->hasOne('App\Models\Branch','id','next');
    }
    public function statusObject() {
        return $this->hasOne('App\Models\ParcelStatus','id','status');
    }



}
