<!-- login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @include('layouts.components.head')
</head>
<body>
    <form id="loginForm">
        @csrf
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>

        <div id="errordisplay"></div>
    </form>

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
                $('#errordisplay').html('An error occurred, please try again later.');
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
