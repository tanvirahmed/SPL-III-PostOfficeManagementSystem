<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Manager extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';


    protected $fillable = [
        'name','nid','dob','password','branch','email','remember_token','type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function assignedBranch()
    {
        return $this->hasOne('App\Models\Branch','id','branch');
    }


}
