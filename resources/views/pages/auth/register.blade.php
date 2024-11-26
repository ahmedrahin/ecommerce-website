@extends('frontend.layout.app')

@section('page-title')
    Register | {{ config('app.name') }}
@endsection

@section('body-content')
<section class="pt-3 login-bg-img ">
    <div class="custom-container container login-page">
        <div class="row align-items-center">
            <div class="col-xxl-7 col-6 d-none d-lg-block">
                <div class="login-img">
                    <img class="img-fluid" src="{{ asset('frontend/images/1.svg') }}">
                </div>
            </div>
            <div class="col-xxl-4 col-lg-6 mx-auto">
                <div class="log-in-box">
                    <div class="log-in-title">
                        <h4>Welcome To {{ config('app.name') }}</h4>
                        <p>Create New Account</p>
                    </div>
                    <div class="login-box">
                        <form id="registerForm" method="POST">
                            @csrf
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="name" type="text" name="name" placeholder="Full Name">
                                    <label for="name">Enter Your Name</label>
                                    <div class="text-danger mt-2" id="nameError"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com">
                                    <label for="email">Enter Your Email</label>
                                    <div class="text-danger mt-2" id="emailError"></div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="password" type="password" name="password" placeholder="Password">
                                    <label for="password">Enter Your Password</label>
                                    <div class="text-danger mt-2" id="passwordError"></div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password">
                                    <label for="password_confirmation">Confirm Your Password</label>
                                    <div class="text-danger mt-2" id="passwordConfirmationError"></div>
                                </div>
                            </div>
                            
                           
                            <button class="btn login btn_black sm" id="registerButton" type="submit">
                                <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                Sign Up
                            </button>
                        </form>
                    </div>
                    <div class="sign-up-box">
                        <p>Already have an account?</p>
                        <a href="{{ route('user.login') }}">Log In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page-script')
    <script src="{{asset('frontend/js/jq.min.js')}}"></script>
    <script>
      $(document).ready(function () {
            $("#registerForm").on("submit", function (e) {
                e.preventDefault();

                // Clear previous errors
                $("#nameError").text("");
                $("#emailError").text("");
                $("#passwordError").text("");
                $("#passwordConfirmationError").text("");

                // Show spinner and disable button
                $("#spinner").removeClass("d-none");
                $("#registerButton").prop("disabled", true);

                // Form data
                let formData = {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    password: $("#password").val(),
                    password_confirmation: $("#password_confirmation").val(),
                };

                $.ajax({
                    url: "{{ route('user.register') }}",
                    type: "POST",
                    data: formData,
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        window.location.href = "{{ route('homepage') }}";
                    },
                    error: function (xhr) {
                        if (xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $("#nameError").text(errors.name[0]);
                            }
                            if (errors.email) {
                                $("#emailError").text(errors.email[0]);
                            }
                            if (errors.password) {
                                $("#passwordError").text(errors.password[0]);
                            }
                            if (errors.password_confirmation) {
                                $("#passwordConfirmationError").text(errors.password_confirmation[0]);
                            }
                        }
                    },
                    complete: function () {
                        // Hide spinner and enable button
                        $("#spinner").addClass("d-none");
                        $("#registerButton").prop("disabled", false);
                    },
                });
            });
        });

    </script>
@endsection
