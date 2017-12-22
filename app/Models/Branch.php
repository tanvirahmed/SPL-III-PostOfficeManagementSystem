<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Branch extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'branch';


    protected $fillable = [
        'name','post_code','manager','zilla','district','upzilla','llong','lat'
    ];
    public function manager()
    {
        return $this->hasOne('App\Models\Manager','branch','id');
    }



}
