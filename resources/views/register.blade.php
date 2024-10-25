<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Janani - Multispeciality Hospital</title>
    <link rel="shortcut icon" href="{{ asset('../images/janani-logo.png') }}" type="image/x-icon">
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('links')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body style="background-color: gainsboro;">

    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-3 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                    </div>

                                    <form class="row g-3" id="addUser">
                                        @csrf
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="mobile" class="text-muted"><span class="text-danger">*</span>Mobile No</label>
                                                <input type="text" name="mobile" id="mobile" placeholder="Mobile no" class="form-control">
                                            </div>
                                            <div id="mobileErrorMsg" class="text-danger font-weight-bold"></div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password" class="text-muted"><span class="text-danger">*</span>Password</label>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                                            </div>
                                            <div id="passwordErrorMsg" class="text-danger font-weight-bold"></div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password_confirmation" class="text-muted"><span class="text-danger">*</span>Confirm Password</label>
                                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter confirm password">
                                            </div>
                                            <div id="password_confirmationErrorMsg" class="text-danger font-weight-bold"></div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a href="{{ url('/') }}">Log in</a></p>
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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- Include Axios -->

    <script>
        async function sendAxiosRequest(method, apiEndpoint, data) {
            let config = {
                method: method,
                maxBodyLength: Infinity,
                url: `${apiEndpoint}`, // Use relative URL
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer {{ session('token') }}` // Authorization token
                },
                data: data
            };

            try {
                const response = await axios.request(config);
                return response;
            } catch (error) {
                if (error.response && error.response.status === 401) {
                    alert('Please login to continue.');
                    window.location.href = '/login'; // Redirect to login page
                } else {
                    throw error;
                }
            }
        }

        $(document).ready(function() {
            $(document).on('submit', '#addUser', function(e) {
                e.preventDefault();

                let mobile = $('#mobile').val();
                let password = $('#password').val();
                let password_confirmation = $('#password_confirmation').val();
                let role = 'patient';

                let formData = {
                    mobile,
                    password,
                    password_confirmation,
                    role,
                };

                sendAxiosRequest('post', '/api/user-auth', formData)
                    .then(response => {
                        if (response.data.status) {
                            alert(response.data.message);
                            // Optional: Redirect or reload after success
                            window.location.href = "{{ url('/') }}"; // Adjust URL as needed
                        } else {
                            alert(response.data.message);
                            response.data.status ? location.reload() : '';
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        let errorMsgs = error.response.data.errors;

                        for (const errorMsgKey in errorMsgs) {
                            if (errorMsgs.hasOwnProperty(errorMsgKey)) {
                                console.log(errorMsgKey, errorMsgs[errorMsgKey]);
                                $(`#${errorMsgKey}ErrorMsg`).html(errorMsgs[errorMsgKey].join(","));
                            }
                        }
                    });
            });

            $(document).on('input', '.form-control', function() {
                let id = $(this).attr('id');
                let value = $(this).val();
                value != '' ? $(`#${id}ErrorMsg`).html('') : '';
            });
        });
    </script>

</body>

</html>
