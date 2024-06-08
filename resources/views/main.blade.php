<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <title>Main</title>
    <style>
        .bd {
            font-family: 'Times New Roman', Times, serif;
            background-color: rgb(240, 240, 237);
        }
        .nav-link {
            color: rgb(160, 157, 152);
            font-weight: bold;
            font-size: 130%;
        }
        a:hover {
            color: rgb(46, 44, 41);
        }
        .container {
            background-color: rgb(225, 226, 218);
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: 80px auto;
        }
        .form-container {
            display: none;
        }
        h2 {
            text-align: center;
            margin-bottom: 15px;
        }
        .btn {
            background-color: #bfbfbf;
            color: black;
            font-weight: bold;
        }
    </style>
</head>
<body class="bd">

    <div class="container form-container" id="loginForm">
        <form method="post" id="loginFormElement">
            @csrf
            <h2>LOGIN</h2>
            <label for="email"><b>Email</b></label>
            <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" required>
            <label for="password"><b>Password</b></label>
            <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" required>
            <h6 class='mt-2'>Don't have an account? <a href="#" id="showRegister"> Register </a></h6>
            <div class="text-right mt-3">
                <button type="submit" class="btn mt-2" id="lsubmit">Login</button>
            </div>
        </form>
    </div>

    <div class="container form-container" id="registerForm">
        <form method="post" id="registerFormElement">
            @csrf
            <h2>REGISTER</h2>
            <label for="regEmail"><b>Email</b></label>
            <input type="email" class="form-control" placeholder="Enter Email" name="email" id="regEmail" required>
            <label for="regPassword"><b>Password</b></label>
            <input type="password" class="form-control" placeholder="Enter Password" name="password" id="regPassword" required>
            <label for="confirmPassword"><b>Confirm Password</b></label>
            <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" id="confirmPassword" required>
            <h6 class='mt-2'>Already have an account? <a href="#" id="showLogin"> Login </a></h6>
            <div class="text-right mt-3">
                <button type="submit" class="btn mt-2" id="rsubmit">Register</button>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#showLogin').click(function(e) {
                e.preventDefault();
                $('#registerForm').hide();
                $('#loginForm').show();
            });

            $('#showRegister').click(function(e) {
                e.preventDefault();
                $('#loginForm').hide();
                $('#registerForm').show();
            });

            $('#loginForm').show();

            $('#loginFormElement').submit(function(e) {
                let email = $('#email').val();
                let password = $('#password').val();
                fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email, password })
                })
                .then(response => {
                if (!response.ok) {
                    return response.json().then(errorData => { throw errorData });
                }
                return response.json();
                })
                .then(data => {                   
                   // console.log('Success:', data);
                    window.location.href = '/dashboard';
                    //location.reload();
                })
                .catch((error) => {
                    const errorMessage = Object.values(error).flat().join('\n');
                    alert(errorMessage);
                    //console.error('Error:', error);
                    location.reload();
                });
            });

            $('#registerFormElement').submit(function(e) {
                e.preventDefault();

                let email = $('#regEmail').val();
                let password = $('#regPassword').val();
                let password_confirmation = $('#confirmPassword').val();

                fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email, password, password_confirmation })
                })
                .then(response => {
                if (!response.ok) {
                    return response.json().then(errorData => { throw errorData });
                }
                return response.json();
                })
                .then(data => {
                    alert('Registered successfully');
                   // console.log('Success:', data);
                    location.reload();
                })
                .catch((error) => {
                    const errorMessage = Object.values(error).flat().join('\n');
                    alert(errorMessage);
                    //console.error('Error:', error);
                    location.reload();
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
