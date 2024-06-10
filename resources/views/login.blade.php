<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    {{-- add css link file --}}
    @include('links')


</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="#" class="logo d-flex align-items-center w-auto">
                                    <span class="d-none d-lg-block">IT CELL</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your email & password to login</p>
                                    </div>

                                    <form class="row g-3 needs-validation" id="loginFormElement" method="post">
                                        @csrf
                                        <div class="col-12">
                                            <label for="emailUser" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="emailUser" class="form-control"
                                                    id="emailUser" placeholder="Enter your email" required>
                                                <span class="input-group-text" id="inputGroupPrepend">@gmail.com</span>
                                                <input type="hidden" name="email" id="email">
                                                <div class="invalid-feedback">Please enter your email.</div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password"
                                                required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit"
                                                id="lsubmit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have account? <a
                                                    href="pages-register.html">Create an account</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    {{-- javascript code to login --}}
    <script>
        $(document).ready(function() {
            // this code is for storing email
            document.getElementById('emailUser').addEventListener('input', function() {
                document.getElementById('email').value = this.value + '@gmail.com';
            });
            //end here

            //login send request and response
            $('#loginFormElement').submit(function(e) {
                let email = $('#email').val();
                let password = $('#password').val();
                console.log("email:" + email + " password:" + password);
                fetch('/api/login', {
                        method: 'post',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            email,
                            password
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(errorData => {
                                throw errorData
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        //console.log('Success:', data);
                        window.location.href = '/dashboard';
                        //location.reload();
                    })
                    .catch((error) => {
                        const errorMessage = Object.values(error).flat().join('\n');
                        alert(errorMessage);
                        console.error('Error:', error);
                        //location.reload();
                    });
            });
        });
    </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>


</body>

</html>
