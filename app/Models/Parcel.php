<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Parcel extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'parcel';


    protected $fillable = [
        'sender_name','sender_mail','receiver_name','receiver_address','source_post_office','current_post_office','next_post_office','destination_post_office','weight','price','status','tracking_id','created_by','type','pin','receiver_phone','sender_phone'
    ];
        public function sourcePostOffice()
    {
        return $this->hasOne('App\Models\Branch','id','source_post_office');
    }
    public function destinationPostOffice()
    {
        return $this->hasOne('App\Models\Branch','id','destination_post_office');
    }
    public function currentPostOffice()
    {
        return $this->hasOne('App\Models\Branch','id','current_post_office');
    }
    public function nextPostOffice()
    {
        return $this->hasOne('App\Models\Branch','id','next_post_office');
    }
    public function statusObject()
    {
        return $this->hasOne('App\Models\ParcelStatus','id','status');
    }
    public function tracks()
    {
        return $this->hasMany('App\Models\Tracks','parcel','id');
    }



}
