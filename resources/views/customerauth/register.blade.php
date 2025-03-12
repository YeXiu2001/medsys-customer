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
        height: 80px;
        line-height: 80px;
        background: linear-gradient(rgba(39, 39, 39, 1) transparent);
        z-index: 100;
        padding: 0 20px;
    }

    .nav-logo img {
        height: 60px;
    }

    .register {
        margin-top: 6rem;
        width: 80vw;
        max-width: 30rem;
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
        font-size: 24px;
        text-align: center;
        padding: 10px 0;
    }

    .input-field {
        font-size: 14px;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        height: 45px;
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
        margin-bottom: 20px;
    }

    .input-box i {
        position: absolute;
        font-size: 18px;
        top: 50%;
        transform: translateY(-50%);
        left: 15px;
        color: #fff;
    }

    .submit {
        font-size: 14px;
        font-weight: 500;
        color: white;
        height: 45px;
        width: 100%;
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
        flex-direction: column;
        color: #fff;
        font-size: small;
        margin-left: 0;
        margin-bottom: 20px;
        text-align: center;
    }
</style>

<body>
<div class="wrapper">
    <nav class="nav d-flex justify-content-left">
        <div class="nav-logo navbar-brand-box">
            <span class="logo-lg">
                <img src="{{ url('assets/images/logo_only.png') }}" class="logo" alt="" height="75">
            </span>
        </div>
    </nav>

    <form id="registerForm">
        @csrf
        <div>
            <div class="register" id="register">
                <div class="top">
                    <div style="text-align: center;">
                        <img src="{{ url('assets/images/medsys_logo_nobg.png') }}" alt="" height="100" style="margin-bottom: 0; padding: 0;">
                    </div>
                    <header>Sign Up</header>
                </div>

                <div class="input-container">
                    <div class="input-box">
                        <input id="name" type="text" class="input-field form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                        <i class="bx bxs-user"></i>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="input-container">
                    <div class="input-box">
                        <input id="contact" type="text" class="input-field form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" placeholder="Contact No.">
                        <i class="bx bxs-phone"></i>
                        @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="input-container">
                    <div class="input-box">
                        <input id="email" type="email" class="input-field form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
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
                        <input id="password" type="password" class="input-field form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                        <i class="bx bxs-lock-alt"></i>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="input-container">
                    <div class="input-box">
                        <input id="password_confirmation" type="password" class="input-field form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        <i class="bx bxs-lock-alt"></i>
                    </div>
                </div>

                <div class="input-box">
                    <input type="submit" class="btn submit" value="Sign Up">
                </div>
                <div class="two-col">
                    Already have an account? <a href="{{ url('/customer/login') }}" style="color: #259ba6;">Sign in here</a>
                </div>
            </div>
        </div>
    </form>
</div>

@include('layouts.components.script')
<script>
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        let cusformdata = new FormData(this);

        if (cusformdata.get('password') != cusformdata.get('password_confirmation')) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Passwords do not match!',
            });
            return;
        }

        // for(var pair of cusformdata.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }

        $.ajax({
            type: 'POST',
            url: '/customer/addcustomer',
            data: cusformdata,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.fire({
                    title: 'Registration successful!',
                    text: "Redirecting to login page...",
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/customer/login';
                    }
                });
            },
            error: function(xhr, status, error) {

                console.log(xhr.responseJSON.error);
                console.log(xhr.responseJSON.message);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: xhr.responseJSON.message,
                });
            }
        });

    });
</script>
</body>
</html>
