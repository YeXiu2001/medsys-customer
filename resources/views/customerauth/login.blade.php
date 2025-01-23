<!-- login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.components.head')
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #1b263b;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .nav {
        position: fixed;
        top: 0;
        display: flex;
        width: 100%;
        height: 80px; /* Reduced height for mobile */
        line-height: 80px; /* Adjusted line-height */
        background: linear-gradient(rgba(39, 39, 39, 1) transparent);
        z-index: 100;
        padding: 0 20px; /* Add padding for smaller screens */
    }

    .nav-logo img {
        height: 60px; /* Adjust logo height */
    }

    .login {
        width: 80vw;
        max-width: 30rem; /* Adjusted max-width */
        display: flex;
        flex-direction: column;
        transition: 0.5s ease-in-out;
        border-radius: 0.8rem;
        box-shadow: 0px 0px 155px 7px rgba(2, 88, 186, 0.41);
        background: rgba(255, 255, 255, 0.1);
        padding: 20px;
    }

    header {
        color: #fff;
        font-size: 24px; /* Reduced font size */
        text-align: center;
        padding: 10px 0;
    }

    .input-field {
        font-size: 14px; /* Reduced font size for inputs */
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        height: 45px; /* Adjusted height */
        padding: 0 10px 0 45px;
        border: none;
        border-radius: 30px;
        outline: none;
        transition: 0.2s ease;
    }

    .input-box {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        margin-bottom: 20px; /* Adjusted spacing */
    }

    .input-box i {
        position: absolute;
        font-size: 18px; /* Adjusted icon size */
        top: 50%;
        transform: translateY(-50%);
        left: 15px; /* Adjusted spacing */
        color: #fff;
    }

    .submit {
        font-size: 14px; /* Reduced font size */
        font-weight: 500;
        color: white;
        height: 45px;
        width: 100%; /* Adjust width */
        border: none;
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.25);
        cursor: pointer;
        transition: 0.3s ease-in-out;
    }

    .submit:hover {
        background: #259ba6;
        box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 0.2);
    }

    .two-col {
        display: flex;
        flex-direction: column; /* Stack items vertically on mobile */
        color: #fff;
        font-size: small;
        margin-left: 0;
        margin-bottom: 20px;
        text-align: center; /* Center align text */
    }

    .two-col .form-check {
        margin-bottom: 10px; /* Add spacing between checkbox and link */
    }

</style>

<body>
<div class="wrapper">
            <nav class="nav d-flex justify-content-left">
                <div class="nav-logo navbar-brand-box">
                    <span class="logo-lg">
                        <img src="{{url('assets/images/logo_only.png')}}" class="logo" alt="" height="75">
                    </span>
                </div>
            </nav>

            <form id="loginForm" method="POST">
                @csrf
                <div>
                    <div class="login" id="login">
                        <div class="top">
                            <div style="text-align: center;">
                                <img src="{{url('assets/images/medsys_logo_nobg.png')}}" alt="" height="100" style="margin-bottom: 0; padding: 0;">
                            </div>
                            <header>Sign In</header>
                        </div>

                        <div class="input-container">
                                <div class="input-box">
                                    <input id="email" type="email" class="input-field form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                    <i class="bx bxs-envelope"></i>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                        </div>
                        
                        <div class="input-container">
                            <div class="input-box">
                                <input id="password" type="password" class="input-field form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                <i class="bx bxs-lock-alt"></i>
                                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                        </div>

                        <div class="two-col">
                            <div class="form-check one">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="input-box">
                            <input type="submit" class="btn submit" value="Sign In">
                        </div>
                    </div>
                </div>
            </form>
        </div>

    @include('layouts.components.script')
    <script>
        $(document).ready(function() {
    // Set CSRF token in the header for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            type: "POST",
            url: "/customer/verify_login",
            data: {
                email: email,
                password: password
            },
            success: function(response) {
                window.location.href = '/home';
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: xhr.responseJSON.message,
                });
            }
        });
    });
});

    </script>
</body>
</html>
