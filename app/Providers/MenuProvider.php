<?php

namespace App\Providers;


use App\Models\Menu;

use Auth;
use DB;
use Illuminate\Support\ServiceProvider;

class MenuProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.sidebar',function($view)
        {
  $isAdmin =Auth::user()->type==0;
            $view->with('menus',$this->MenuRecursive(0,$isAdmin));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function MenuRecursive($id,$isAdmin=false) {
        $menus=[];
        if($isAdmin)
        $menus = Menu::where('parent',$id)->orderby('id')->get();
        else
            $menus = Menu::where('parent',$id)->where("admin_only",0)->orderby('id')->get();


        foreach ($menus as $menu) {
            $menu->submenu=[];

            $submenu=$this->MenuRecursive($menu->id);
            if($submenu!=null) {
                $menu->submenu=$submenu;
            }


        }
        return $menus;
    }
    public function register()
    {
        //
    }

}
