@extends('frontend.layout.app')

@section('page-title')
    Forgot Password | {{ config('app.name') }}
@endsection

@section('body-content')
    <section class="section-b-space login-bg-img pt-10">
        <div class="custom-container container login-page"> 
        <div class="row align-items-center">
            <div class="col-xxl-7 col-6 d-none d-lg-block">
            <div class="login-img"> <img class="img-fluid" src="{{asset('frontend/images/1.svg')}}" alt=""></div>
            </div>
            <div class="col-xxl-4 col-lg-6 mx-auto">
            <div class="log-in-box">
                <div class="log-in-title"> 
                <h4>Reset your password</h4>
                
                </div>
                <div class="login-box"> 
                    <form class="row g-3" id="otpForm" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="col-12"> 
                            <div class="form-floating">
                                <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com">
                                <label for="email">Enter Your Email</label>
                                <span class="text-danger mt-2" id="emailError"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn login btn_black sm" id="otpButton" type="submit">
                                <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                Send OTP
                            </button>
                        </div>
                    </form>                    
                </div>
                <div class="other-log-in"></div>
                <div class="sign-up-box"><a class="text-decoration-underline" href="{{route('user.login')}}">Back To Login</a></div>
            </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('page-script')
    <script src="{{ asset('frontend/js/jq.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#otpForm").on("submit", function (e) {
                e.preventDefault();

                // Clear previous errors
                $("#emailError").text("");

                // Show spinner and disable button
                $("#spinner").removeClass("d-none");
                $("#otpButton").prop("disabled", true);

                let formData = {
                    email: $("#email").val(),
                };

                $.ajax({
                    url: "{{ route('password.email') }}",
                    type: "POST",
                    data: formData,
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        Toastify({
                            text: "Password reset link sent to your email!",
                            duration: 3000
                        }).showToast();
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) { 
                            let errors = xhr.responseJSON.errors;

                            if (errors.email) {
                                $("#emailError").text(errors.email); 
                            }
                        } else {
                            alert("Something went wrong. Please try again.");
                        }
                    },
                    complete: function () {
                        $("#spinner").addClass("d-none");
                        $("#otpButton").prop("disabled", false);
                    },
                });
            });
        });

    </script>
@endsection
