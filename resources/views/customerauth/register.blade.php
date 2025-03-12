<!DOCTYPE html>
<html lang="en">
<head>
@include('layouts.components.head')
</head>
<body>
    <h2>Customer Form</h2>
    <form id="customerForm">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="contact">Contact:</label>
        <input type="tel" id="contact" name="contact" required><br><br>
        
        <button type="submit">Submit</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#customerForm').on('submit', function(e) {
                e.preventDefault();

                var formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    contact: $('#contact').val()
                };

                $.ajax({
                    type: 'POST',
                    url: '/customer/addcustomer',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {

                        console.log(xhr.responseJSON.error);
                        console.log(xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
</body>
</html>
