@extends('layouts.main')

<link href="{{ asset('css/customfiles/chatting.css') }}" rel="stylesheet">

@section('maincontent')
    <div class="container mt-5 card">
        <h3 class="text-center mt-3">Update Profile</h3>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs mt-3" id="profileTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" role="tab"
                    aria-controls="personal" aria-selected="true">
                    Personal Information
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" role="tab"
                    aria-controls="security" aria-selected="false">
                    Security
                </a>
            </li> --}}
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
                                <label for="fname"><span class="text-danger">*</span> First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname"
                                    placeholder="Enter First Name">
                            </div>
                            <div id="fnameErrorMsg" class="text-danger font-weight-bold"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="lname"><span class="text-danger">*</span> Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                    placeholder="Enter Last Name">
                            </div>
                            <div id="lnameErrorMsg" class="text-danger font-weight-bold"></div>

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
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="dob"><span class="text-danger">*</span> Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob"
                                    placeholder="Select your date of birth">
                            </div>
                            <div id="dobErrorMsg" class="text-danger font-weight-bold"></div>

                        </div>

                        <div class="col-md-6">
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
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>

            <!-- Security Tab -->
            {{-- <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group my-4">
                        <label for="old_password"><span class="text-danger">*</span> Old Password</label>
                        <input type="password" class="form-control" id="old_password" name="old_password"
                            placeholder="Enter your old password">
                    </div>
                    <div class="form-group my-4">
                        <label for="new_password"><span class="text-danger">*</span> New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password"
                            placeholder="Enter your new password">
                    </div>
                    <div class="form-group my-4">
                        <label for="confirm_password"><span class="text-danger">*</span> Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            placeholder="Confirm your new password">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </form>
            </div> --}}
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('submit', '#userDetails', function(e) {
                e.preventDefault();

                let fname = $('#fname').val();
                let lname = $('#lname').val();
                let city = $('#city').val();
                let email = $('#email').val();
                let country = $('#country').val();
                let dob = $('#dob').val();
                let blood_group = $('#blood_group').val();
                let address = $('#address').val();

                let formData = {
                    fname,
                    lname,
                    city,
                    email,
                    country,
                    dob,
                    blood_group,
                    address
                };

                sendAxiosRequest('post', '/api/details-user', formData)
                    .then(response => {
                        if (response.data.status) {
                            alert(response.data.message);
                            // Optional: Redirect or reload after success
                            window.location.href = "{{ url('/') }}";
                        } else {
                            alert(response.data.message);
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
                $("#dob").datepicker({
                    dateFormat: "dd-mm-yy"
                });
            });
        });
    </script>
@endsection
