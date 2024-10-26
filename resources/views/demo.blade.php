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
        <div class="container mt-5">
            <h3>Update Profile</h3>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs mt-3" id="profileTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal"
                        role="tab" aria-controls="personal" aria-selected="true">
                        Personal Information
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" role="tab"
                        aria-controls="security" aria-selected="false">
                        Security
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Personal Information Tab -->
                <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                    <form id="userDetails">
                        @csrf
                        <div class="row my-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="first_name"><span class="text-danger">*</span> First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        placeholder="Enter First Name">
                                </div>
                                <div id="first_nameErrorMsg" class="text-danger font-weight-bold"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="last_name"><span class="text-danger">*</span> Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        placeholder="Enter Last Name">
                                </div>
                                <div id="last_nameErrorMsg" class="text-danger font-weight-bold"></div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="city"><span class="text-danger">*</span> City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="Enter City">
                                </div>
                                <div id="cityErrorMsg" class="text-danger font-weight-bold"></div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country" name="country"
                                        placeholder="Enter Country">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="dob"><span class="text-danger">*</span> Date of Birth</label>
                                    <input type="date" class="form-control" id="datepicker" name="dob"
                                        placeholder="Select your date of birth">
                                </div>
                                <div id="datepickerErrorMsg" class="text-danger font-weight-bold"></div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="mobile"><span class="text-danger">*</span> Mobile No</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                        placeholder="Enter Mobile No">
                                </div>
                                <div id="mobileErrorMsg" class="text-danger font-weight-bold"></div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="blood_group"><span class="text-danger">*</span> Blood Group</label>
                                    <select class="form-control" id="blood_group" name="blood_group">
                                        <option value="">Select Blood Group</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                                <div id="blood_groupErrorMsg" class="text-danger font-weight-bold"></div>

                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter Current Address"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Personal Information</button>
                    </form>
                </div>

                <!-- Security Tab -->
                <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group my-4">
                            <label for="old_password"><span class="text-danger">*</span> Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password"
                                placeholder="Enter your old password" required>
                        </div>
                        <div class="form-group my-4">
                            <label for="new_password"><span class="text-danger">*</span> New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password"
                                placeholder="Enter your new password" required>
                        </div>
                        <div class="form-group my-4">
                            <label for="confirm_password"><span class="text-danger">*</span> Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password"
                                name="confirm_password" placeholder="Confirm your new password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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
            $(document).on('submit', '#userDetails', function(e) {
                e.preventDefault();

                let fname = $('#first_name').val();
                let lname = $('#last_name').val();
                let city = $('#city').val();
                let email = $('#email').val();
                let country = $('#country').val();
                let dob = $('#datepicker').val();
                let mobile = $('#mobile').val();
                let bloodgroup = $('#blood_group').val();
                let address = $('#address').val();

                let formData = {
                    fname,
                    lname,
                    city,
                    email,
                    country,
                    dob,
                    mobile,
                    bloodgroup,
                    address
                };

                sendAxiosRequest('post', '/api/details-user', formData)
                    .then(response => {
                        if (response.data.status) {
                            alert(response.data.message);
                            // Optional: Redirect or reload after success
                            // window.location.href = "{{ url('/profile') }}";
                        } else {
                            alert(response.data.message);
                            // response.data.status ? location.reload() : '';
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

            // date picker
            $(function() {
                $("#datepicker").datepicker({
                    dateFormat: "dd-mm-yy"
                });
            });
        });
    </script>

</body>

</html>
