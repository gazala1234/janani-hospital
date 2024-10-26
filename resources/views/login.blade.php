<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Janani - Multispeciality Hospital</title>
    @include('links')
</head>

<body style="background-color: gainsboro;">
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body mb-5">
                                    <div class="pt-3 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                                    </div>

                                    <form class="row g-3" id="otpLoginForm">
                                        @csrf
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="mobile" class="text-muted"><span class="text-danger">*</span> Mobile No</label>
                                                <input type="text" name="mobile" id="mobile" placeholder="Enter mobile number" class="form-control">
                                            </div>
                                            <div id="mobileErrorMsg" class="text-danger font-weight-bold"></div>
                                        </div>

                                        <div class="col-12">
                                            <button type="button" id="sendOtpButton" class="btn btn-primary w-100 mt-3">Send OTP</button>
                                        </div>

                                        <div class="col-12" id="otpSection" style="display: none;">
                                            <div class="form-group">
                                                <label for="otp" class="text-muted"><span class="text-danger">*</span> OTP</label>
                                                <input type="text" name="otp" id="otp" placeholder="Enter OTP" class="form-control">
                                            </div>
                                            <div id="otpErrorMsg" class="text-danger font-weight-bold"></div>
                                        </div>

                                        <div class="col-12" id="verifyOtpSection" style="display: none;">
                                            <button class="btn btn-primary w-100" type="submit" id="verifyOtpButton">Login</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        async function sendAxiosRequest(method, apiEndpoint, data) {
            let config = {
                method: method,
                url: `${apiEndpoint}`,
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                data: data
            };

            try {
                const response = await axios.request(config);
                return response;
            } catch (error) {
                throw error;
            }
        }

        $(document).ready(function() {
            // Send OTP when button is clicked
            $('#sendOtpButton').on('click', function() {
                let mobile = $('#mobile').val();

                // Hide the Send OTP button and show OTP input and Verify button sections
                $('#sendOtpButton').hide();

                sendAxiosRequest('post', '/api/login/send-otp', { mobile: mobile })
                    .then(response => {
                        alert(response.data.message);
                        $('#otpSection, #verifyOtpSection').show(); // Show OTP input and verify button
                    })
                    .catch(error => {
                        console.log(error);
                        let errorMsgs = error.response.data.errors;
                        $('#mobileErrorMsg').html(errorMsgs ? errorMsgs.mobile.join(",") : 'Failed to send OTP');
                        $('#sendOtpButton').show(); // Show Send OTP button again if there's an error
                    });
            });

            // Verify OTP when form is submitted
            $('#otpLoginForm').on('submit', function(e) {
                e.preventDefault();

                let formData = {
                    mobile: $('#mobile').val(),
                    otp: $('#otp').val()
                };

                sendAxiosRequest('post', '/api/login/verify-otp', formData)
                    .then(response => {
                        if (response.data.status) {
                            alert(response.data.message);
                            window.location.href = "{{ url('/dashboard') }}";
                        } else {
                            alert(response.data.message);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        let errorMsgs = error.response.data.errors;
                        $('#otpErrorMsg').html(errorMsgs ? errorMsgs.otp.join(",") : 'Failed to verify OTP');
                    });
            });

            // Clear error messages on input
            $(document).on('input', '.form-control', function() {
                let id = $(this).attr('id');
                $(`#${id}ErrorMsg`).html('');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
</body>

</html>
