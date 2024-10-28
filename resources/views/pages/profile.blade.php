@extends('layouts.main')

<link href="{{ asset('css/customfiles/chatting.css') }}" rel="stylesheet">

<style>
    @media (max-width: 768px) {
        .profile-card {
            margin-top: 30px !important;
        }
    }

    .profile-card {
        width: auto;
        height: auto;
        background-color: #ffffff;
        margin-top: 70px;
        box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.15);
    }

    .card_profile_img {
        width: 120px;
        height: 120px;
        background-color: #868d9b;
        background: url("../images/profile.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        border: 2px solid #ffffff;
        border-radius: 120px;
        margin: 0 auto;
        margin-top: -60px;

    }

    .card_background_img {
        width: 100%;
        height: 180px;
        background-color: #e1e7ed;
        background: url("https://images.unsplash.com/photo-1620554601463-299d29b2733b?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }

    .user_details h3 {
        margin-top: 10px;
    }

    .card_count {
        padding: 30px;
        border-top: 1px solid #dde1e7;
    }

    .count {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 40px;
    }

    .followers,
    .following {
        margin: 0 10px;
        text-align: center;
    }
</style>

@section('maincontent')
    <div class="profile-card">
        <div class="card_background_img"></div>
        <div class="card_profile_img"></div>
        <div class="user_details text-center">
            @php
                $role = session('role');
                $userDetails = session('userDetails');
            @endphp
            <h3>{{ $role
                ? (($userDetails['fname'] ?? null) && ($userDetails['lname'] ?? null)
                    ? $userDetails['fname'] . ' ' . $userDetails['lname']
                    : 'Patient')
                : 'Guest' }}
            </h3>
            <h6>{{ $userDetails['email'] ?? '@guestmail' }}</h6>
            <h6>{{ session('role') }}</h6>
            <a href="{{ url('api/settings') }}" class="text-decoration-none">
                <button type="button" class="btn btn-outline-primary my-3">Edit Profile</button>
            </a>

            <a href="{{ url('api/settings') }}" class="text-decoration-none">
                <button type="button" class="btn btn-outline-primary my-3">Activities</button>
            </a>
        </div>
        <div class="card_count">
            {{-- <div class="count">
                <div class="followers">
                    <h3>2.4M</h3>
                    <h6>Followers</h6>
                </div>
                <div class="following">
                    <h3>202</h3>
                    <h6>Followings</h6>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
