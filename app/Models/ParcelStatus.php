<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class ParcelStatus extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'parcel_status';


    protected $fillable = [
        'title'
    ];




}
