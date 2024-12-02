@extends('frontend.layout.app')

@section('page-title')
    Login | {{ config('app.name') }}
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
                    <p>Login to Your Account</p>
                  </div>
                  <div class="login-box"> 
                    <form id="loginForm" class="row g-3">
                      @csrf
                      <div class="col-12"> 
                        <div class="form-floating">
                          <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com">
                          <label for="email">Enter Your Email</label>
                          <div class="text-danger mt-2" id="emailError"></div>
                        </div>
                      </div>
                      <div class="col-12"> 
                        <div class="form-floating">
                          <input class="form-control" id="password" type="password" name="password" placeholder="Password">
                          <label for="password">Enter Your Password</label>
                          <div class="text-danger mt-2" id="passwordError"></div>
                        </div>
                      </div>
                      <div class="col-12">
                            <div class="forgot-box">
                                <div>
                                    <input class="custom-checkbox me-2" id="remember" type="checkbox" name="remember">
                                    <label for="remember">Remember me</label>
                                </div>
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            </div>
                        </div>
                    
                      <div class="col-12"> 
                        <button class="btn login btn_black sm" id="loginButton" type="submit">
                          <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                          Log In
                        </button>
                      </div>
                    </form>
                  </div>
                  <div class="sign-up-box"> 
                    <p>Don't have an account?</p><a href="{{ route('register') }}">Sign Up</a>
                  </div>
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
            $("#loginForm").on("submit", function (e) {
                e.preventDefault();

                // Clear previous errors
                $("#emailError").text("");
                $("#passwordError").text("");

                // Show spinner and disable button
                $("#spinner").removeClass("d-none");
                $("#loginButton").prop("disabled", true);

                // Form data
                let formData = {
                    email: $("#email").val(),
                    password: $("#password").val(),
                    remember: $("#remember").is(":checked"), 
                };

                $.ajax({
                    url: "{{ route('user.login') }}",
                    type: "POST",
                    data: formData,
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        // Redirect to homepage on successful login
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    },
                    error: function (xhr) {
                        if (xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;

                            if (errors.email) {
                                $("#emailError").text(errors.email);
                            }

                            if (errors.password) {
                                $("#passwordError").text(errors.password[0]);
                            }
                        }
                    },

                    complete: function () {
                        // Hide spinner and enable button
                        $("#spinner").addClass("d-none");
                        $("#loginButton").prop("disabled", false);
                    },
                });
            });
        });


    </script>

    @if (session('info'))
    <script>
        toastr.error("{{ session('info') }}");
    </script>
    @endif
@endsection
