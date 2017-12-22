<?php

namespace App\Providers;


use App\Models\Menu;

use Auth;
use DB;
use Illuminate\Support\ServiceProvider;

class MessageProvider extends ServiceProvider
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

//            $view->with('menus',$this->MenuRecursive(0));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function MenuRecursive($id) {
        $menus = Menu::where('parent',$id)->orderby('id')->get();


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
