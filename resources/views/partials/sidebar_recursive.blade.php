
<ul class="treeview-menu">

    @foreach($menus as $menu)
        @if((count($menu->submenu))==0)
            <li>
                <a href="{{$menu->route=="#"?"":route($menu->route)}}">
                    <i class="{{$menu->icon}}"></i> <span>{{$menu->title}}</span>

                </a>
            </li>

        @else
        <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
                <a href="#"><i class="{{$menu->icon}}"></i> <span>{{$menu->title}}</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                @include('partials.sidebar_recursive',["menus"=>$menu->submenu])
            </li>
        @endif
    @endforeach
</ul>
