@extends('frontend.layout.app')
    
@section('page-title')
    Dashboard | {{config('app.name')}}
@endsection
  

@section('page-css')
    <style>
        .invoice-box a {
            font-weight: 500;
            font-size: 16px;
            background: #000000b8;
            color: white !important;
            padding: 5px 10px;
            border-radius: 3px;
        }
    </style>
@endsection

@section('body-content')

    <section class="section-b-space pt-0 pb-0"> 
        <div class="custom-container container user-dashboard-section"> 
        <div class="row">
            <div class="col-xl-3 col-lg-4">
            <div class="left-dashboard-show">
                <button class="btn btn_black sm rounded bg-primary">Show Menu</button>
            </div>
            <div class="dashboard-left-sidebar sticky">
                <div class="profile-box"> 
                <div class="profile-bg-img"></div>
                <div class="dashboard-left-sidebar-close"><i class="fa-solid fa-xmark"></i></div>

                    <livewire:frontend.user.contactinfo :user_id="$user->id" />
                    
                </div>
                
                <ul class="nav flex-column nav-pills dashboard-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <li>
                        <button class="nav-link active" id="dashboard-tab" data-bs-toggle="pill" data-bs-target="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true"><i class="iconsax" data-icon="home-1"></i> Dashboard</button>
                    </li>
                    
                    <li>
                        <button class="nav-link" id="order-tab" data-bs-toggle="pill" data-bs-target="#order" role="tab" aria-controls="order" aria-selected="false"><i class="iconsax" data-icon="receipt-square"></i> Order</button>
                    </li>
                    {{-- <li>
                        <button class="nav-link" id="wishlist-tab" data-bs-toggle="pill" data-bs-target="#wishlist" role="tab" aria-controls="wishlist" aria-selected="false"> <i class="iconsax" data-icon="heart"></i>Wishlist </button>
                    </li> --}}

                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <div class="logout-button"> <a class="btn btn_black sm"  href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="iconsax me-1" data-icon="logout-1"></i> Logout </a></div>
            </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <div class="dashboard-right-box">
                        <div class="my-dashboard-tab">
                        <div class="dashboard-items"> </div>
                        
                        <div class="total-box"> 
                            <div class="row gy-4"> 
                            <div class="col-xl-4"> 
                                <div class="totle-contain">
                            
                                <div class="totle-detail"> 
                                    <h6>Total Order</h6>
                                    <h4>{{$user->orders->count()}}</h4>
                                </div>
                                </div>
                            </div>
                            <div class="col-xl-4"> 
                                <div class="totle-contain">
                            
                                <div class="totle-detail"> 
                                    <h6>Total Cost</h6>
                                    <h4>৳{{$user->orders->sum('grand_total')}}</h4>
                                </div>
                                </div>
                            </div>
                            <div class="col-xl-4"> 
                                <div class="totle-contain">
                                
                                <div class="totle-detail"> 
                                    <h6>Pending Order</h6>
                                    <h4>{{$user->orders->where('delivery_status', 'pending')->count()}}</h4>
                                </div>
                                </div>
                            </div>
                        
                            </div>
                        </div>
                        <div class="profile-about"> 
                            <div class="row"> 
                                <livewire:frontend.user.profile-infromation :user_id="$user->id" />
                                    <div class="sidebar-title">
                                    <div class="loader-line"></div>
                                    <h5>Login Details</h5>
                                    </div>
                                    <ul class="profile-information mb-0"> 
                                        <li> 
                                            <h6>Email :</h6>
                                            <p>{{$user->email}}</p>
                                        </li>
                                        <li> 
                                            <h6>Password :</h6>
                                            <p>●●●●●●<span data-bs-toggle="modal" data-bs-target="#edit-password" tabindex="0">Change password</span></p>
                                        </li>
                                    </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    
                    <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
                        @include('frontend.pages.user.order-list')
                    </div>
                    
                </div>
            </div>
        </div>
        </div>
    </section>

    <livewire:frontend.user.edit-profile :user_id="$user->id" />
    <livewire:frontend.user.change-password :user_id="$user->id" />

@endsection
    
@section('page-script')
   <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('success', () => {
            setTimeout(() => {
                const modalElement = document.getElementById('edit-box');
                const modalInstance = bootstrap.Modal.getInstance(modalElement); 
                modalInstance.hide();
            }, 1000);
            setTimeout(() => {
                const modalElement = document.getElementById('edit-password');
                const modalInstance = bootstrap.Modal.getInstance(modalElement); 
                modalInstance.hide();
            }, 1000);
            });
        });

        const modal = document.querySelector('#edit-box');
        modal.addEventListener('show.bs.modal', (e) => {
            Livewire.emit('open_add_modal');
        });

        const modalPass = document.querySelector('#edit-password');
        modalPass.addEventListener('show.bs.modal', (e) => {
            Livewire.emit('open_add_modal');
        });

        document.querySelector('.left-dashboard-show').addEventListener('click', function() {
            document.querySelector('.dashboard-left-sidebar').classList.add('open');
        });

        document.querySelector('.dashboard-left-sidebar-close').addEventListener('click', function() {
            document.querySelector('.dashboard-left-sidebar').classList.remove('open');
        });
        
   </script>

@endsection

    
    
    
    
   
 