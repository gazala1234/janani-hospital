@extends('layouts.main')

<link href="{{ asset('css/customfiles/chatting.css') }}" rel="stylesheet">

@section('maincontent')
    <div class="card mt-5">
        <div class="card-header">
            <h3 class="text-center">Book Consultation</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter Email" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">Phone no</label>
                        <input type="number" class="form-control" id="phone" name="phone"
                            placeholder="Enter Phone No" required>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Message</label>
                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter Message" required></textarea>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3">Book Consult</button>
                </div>
            </form>
        </div>
    </div>
@endsection
