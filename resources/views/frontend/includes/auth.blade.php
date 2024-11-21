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
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>
  </li>
@endif
