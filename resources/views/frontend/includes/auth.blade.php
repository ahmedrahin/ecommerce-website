@if( !Auth::check() )
  <li class="onhover-div">
    <i class="iconsax" data-icon="user-2" style="cursor: pointer;"></i>
      <div class="onhover-show-div user"> 
        <ul> 
          <li> <a href="{{ route('user.login') }}">Login </a></li>
          <li> <a href="{{ route('register') }}">Register</a></li>
        </ul>
      </div>
  </li>
@else
  <li class="onhover-div">
    @php
        $route = Auth::user()->isAdmin == 1 ? route('admin-management.admin-list.show', Auth::id()) : route('user.dashboard');
    @endphp
    <a href="{{ $route }}">
        <i class="iconsax" data-icon="user-2"></i>
    </a>

  </li>
@endif
