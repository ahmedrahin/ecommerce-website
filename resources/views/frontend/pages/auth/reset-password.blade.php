@extends('frontend.layout.app')

@section('page-title')
    Reset Password | {{ config('app.name') }}
@endsection

@section('body-content')
<section class="section-b-space login-bg-img pt-10">
    <div class="custom-container container login-page"> 
        <div class="row align-items-center">
            <div class="col-xxl-7 col-6 d-none d-lg-block">
                <div class="login-img"> 
                    <img class="img-fluid" src="{{asset('frontend/images/1.svg')}}" alt="">
                </div>
            </div>
            <div class="col-xxl-4 col-lg-6 mx-auto">
                <div class="log-in-box">
                    <div class="log-in-title"> 
                        <h4>New Password</h4>
                    </div>
                    <div class="login-box">
                        <form class="row g-3" action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->token }}">
                            <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

                            <div class="col-12">
                                <div class="form-floating">
                                    <input class="form-control" id="password" name="password" type="password" placeholder="New Password">
                                    <label for="password">New Password</label>
                                    @error('password')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password">
                                    <label for="password_confirmation">Confirm Password</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn login btn_black sm" type="submit">
                                    Reset Password
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="other-log-in"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
