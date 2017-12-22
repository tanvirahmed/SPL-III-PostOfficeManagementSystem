<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Menu extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'menu';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $fillable = [
        'title','icon','route','parent'
    ];
    public function submenu()
    {
        return $this->hasMany('App\Models\Menu','id','parent');
    }



}
