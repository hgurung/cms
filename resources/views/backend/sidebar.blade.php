<ul id="sidebar-menu">
  @foreach($modulesPermission as $modules)
    <?php if($modules['pages']>1) $url = "#";else $url = PREFIX."/".$modules['id'];?>
  <li>
      <a href="{{URL::to($url)}}" title="{{$modules['title']}}" >
          <i class="glyph-icon {{$modules['icon']}}"></i>
          <span>{{$modules['title']}}</span>
      </a>
      @if($modules['pages']>1)
        <div class="sidebar-submenu">

            <ul>
                @foreach($modules['subPages'] as $pageId=>$pageTitle)
                  <?php $url = PREFIX."/".$modules['id']."/pages/".$pageId;?>
                  <li><a href="{{URL::to($url)}}" title="{{$pageTitle}}"><span>{{$pageTitle}}</span></a></li>
                @endforeach
            </ul>

        </div><!-- .sidebar-submenu -->
      @endif
  </li>
  <li class="divider"></li>
  @endforeach
  
</ul><!-- #sidebar-menu -->
