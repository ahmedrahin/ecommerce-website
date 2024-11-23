<div >
    <div class="profile-contain">
        <div class="profile-image">
            @if( !is_null($user->avatar) )
                <img class="img-fluid" src="{{asset($user->avatar)}}" >
            @else
                <img class="img-fluid" src="{{asset('uploads/user.png')}}" >
            @endif
        </div>
        <div class="profile-name"> 
        <h4>{{$user->name}}</h4>
        <h6>{{$user->email}}</h6><span data-bs-toggle="modal" data-bs-target="#edit-box" title="Quick View" tabindex="0">Edit Profile</span>
        </div>
    </div>

</div>
