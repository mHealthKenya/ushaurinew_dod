<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/jpeg" sizes="16x16" href="{{ asset('assets/images/ushauri.jpeg') }}">
        <title>Ushauri - Getting better one text at a time</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/styles/css/themes/lite-purple.min.css')}}">
    </head>

    <body>
        <div class="auth-layout-wrap">
            <div class="auth-content">
                <div class="card o-hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-4">
                                <div class="auth-logo text-center mb-4">
                                <img src="{{ asset('/assets/images/ushauri_logo.png') }}" style="margin-left: 50px;" width="51%" height="60%" >

                                  <h4>Login</h4>
                                </div>

                                <form method="POST" id="login_form" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Phone Number/Email address</label>
                                        <input id="email" type="text"
                                            class="form-control form-control-rounded @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" type="password"
                                            class="form-control form-control-rounded @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group ">
                                        <div class="">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-rounded btn-primary btn-block mt-2">Sign In</button>

                                </form>
                                @if (Route::has('password.request'))

                                <div class="mt-3 mb-1 text-center">

                                    <a href="javascript::void(0)" class="forgot_password_link" id="forgot_password_link""><u>Forgot
                                            Password?</u></a>
                            
                                </div>
                                @endif
                                <div class="center">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="pl-3" src="{{ asset('assets/images/login/moh.png') }}" alt="ushauri" height="40">
                                        </div>

                                        <div class="col-md-3">
                                            <img class="pl-3" src="{{ asset('assets/images/login/CDC-LOGO.jpg') }}" alt="ushauri" height="40">
                                        </div>

                                        <div class="col-md-3">
                                            <img class="pl-3" src="{{ asset('assets/images/login/logo_3.png') }}" alt="ushauri" >
                                        </div>

                                        <div class="col-md-3">
                                            <img class="pl-3" src="{{ asset('assets/images/login/NASCOP_Logo.png') }}" alt="ushauri" width="50%">
                                        </div>
                                    </div>

                                </div>
                                <div class="register-link m-t-15 text-center">
                                    <p>&copy;  mHealth Kenya &nbsp;2016 - <?php echo date('Y'); ?> <b> Powered by : <a href="https://mhealthkenya.org/" target="_blank"> mHealth  Kenya </a></b> </p>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{asset('assets/js/common-bundle-script.js')}}"></script>

        <script src="{{asset('assets/js/script.js')}}"></script>

        <!-- Sweet alert -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

        <script>
            var loginForm = $("#login_form");
            loginForm.submit(function (e) {
                e.preventDefault();
                var thisForm = $(this);
                var endPoint = thisForm.attr("action") || window.location.href;
                var method = thisForm.attr("method");
                var formData = thisForm.serialize();

                console.log(endPoint);
                console.log(method);
                Swal.fire({
                    title: "Please wait, Logging In!",
                    imageUrl: "/images/Ripple.gif",
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                this.submit();

            });

            $(document).ready(function () {
                $(".forgot_password_link").click(function () {
                    Swal.fire({
                        title: "Not Allowed!",
                        text: "Kindly contact the Support / Your Help Desk Incharge to reset your password."
                    });
                });
            });
        </script>

    </body>

</html>