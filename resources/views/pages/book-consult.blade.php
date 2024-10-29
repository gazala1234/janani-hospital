@extends('layouts.main')

<link href="{{ asset('css/customfiles/chatting.css') }}" rel="stylesheet">

@section('maincontent')
    <div class="card mt-5">
        <div class="card-header">
            <h3 class="text-center">Book Consultation</h3>
        </div>
        <div class="card-body">
            <form id="bookConsult">
                @csrf
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name"><span class="text-danger">*</span> Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Name">
                            <div id="nameErrorMsg" class="text-danger font-weight-bold"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone"><span class="text-danger">*</span> Phone</label>
                        <input type="number" class="form-control" id="phone" name="phone"
                            placeholder="Enter Phone No">
                        <div id="phoneErrorMsg" class="text-danger font-weight-bold"></div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date"><span class="text-danger">*</span> Date</label>
                            <input type="date" class="form-control" id="date" name="date">
                            <div id="dateErrorMsg" class="text-danger font-weight-bold"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="time"><span class="text-danger">*</span> Time</label>
                            <input type="time" class="form-control" id="time" name="time">
                            <div id="timeErrorMsg" class="text-danger font-weight-bold"></div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="query"><span class="text-danger">*</span> Query</label>
                        <textarea class="form-control" id="query" name="query" rows="3" placeholder="Write your query here..."></textarea>
                        <div id="queryErrorMsg" class="text-danger font-weight-bold"></div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3">Book Consult</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('submit', '#bookConsult', function(e) {
                e.preventDefault();

                let name = $('#name').val();
                let email = $('#email').val();
                let phone = $('#phone').val();
                let date = $('#date').val();
                let time = $('#time').val();
                let query = $('#query').val();

                let formData = {
                    name,
                    email,
                    phone,
                    date,
                    time,
                    query
                };

                sendAxiosRequest('post', '/api/book-consult', formData)
                    .then(response => {
                        if (response.data.status) {
                            alert(response.data.message);
                            location.reload();
                        } else {
                            alert(response.data.message);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        if (error.response && error.response.data) {
                            if (error.response.data.errors) {
                                let errorMsgs = error.response.data.errors;
                                for (const errorMsgKey in errorMsgs) {
                                    if (errorMsgs.hasOwnProperty(errorMsgKey)) {
                                        $(`#${errorMsgKey}ErrorMsg`).html(errorMsgs[errorMsgKey].join(
                                            ","));
                                    }
                                }
                            } else {
                                alert(error.response.data.message);
                            }
                        } else {
                            alert('An unexpected error occurred. Please try again.');
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
@endsection
