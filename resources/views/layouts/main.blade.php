<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <title>Janani - Multispeciality Hospital</title>
    <link rel="shortcut icon" href="{{ asset('../images/janani-logo.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('css/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/mainstyle/style.css') }}" rel="stylesheet">
</head>
<style>
    .recent-message {
        align-items: center;
    }

    .avatar.profile img {
        border-radius: 50%;
    }

    .name {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .hospital-logo {
        max-width: 100%;
        height: auto;
        padding: 0 10px;
        margin: 10px 0;
    }

    @media (max-width: 768px) {
        .hospital-logo {
            max-width: 100px;
        }

        h3 {
            font-size: 1rem;
        }
    }
</style>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center justify-content-between p-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Logo Section -->
                <div class="col-3 col-md-2 d-flex justify-content-center">
                    <a href="{{ url('/dashboard') }}">
                        <img src="../images/janani-logo.png" class="hospital-logo" alt="Logo">
                    </a>
                </div>

                <!-- Sidebar Toggle Section -->
                <div class="col-3 col-md-2">
                    <i class="bi bi-list toggle-sidebar-btn"></i>
                </div>

                <div class="col-6 text-center">
                    <h3 class="my-0">JANANI - MULTISPECIALITY HOSPITAL</h3>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('register') }}" class="text-decoration-none">
                        <button type="button" class="btn btn-outline-primary">Signin</button>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav mt-3" id="sidebar-nav">
            @include('layouts.menu')
        </ul>
    </aside>
    <!-- End Sidebar-->


    <main id="main" class="main">
        {{-- dashboard content will come here --}}
        <section class="section dashboard" id="section">
            <div class="row">
                <div class="col-12 col-lg-9">
                    @yield('maincontent')
                </div>
                <div class="col-12 col-lg-3 mt-5">
                    <div class="card">
                        <div class="card-body py-4 px-4">
                            <div class="d-flex align-items-center user-profile">
                                <div class="avatar profile avatar-xl">
                                    <img src="../images/profile.jpg" alt="User">
                                </div>
                                <div class="ms-3 name">
                                    {{-- @if (auth()->check()) --}}
                                    <pre>{{ print_r(session('user'), true) }}</pre>

                                        <h5 class="font-bold">
                                            {{ isset(session('user')->userDetails->name) ? session('user')->userDetails->name : 'Guest' }}

                                        </h5>
                                        <h6 class="text-muted mb-0">
                                            {{ isset(session('user')->email) ? session('user')->email : '@guestmail' }}

                                        </h6>
                                    {{-- @else --}}
                                        {{-- <h5 class="font-bold">Guest</h5>
                                        <h6 class="text-muted mb-0">@guestmail</h6> --}}
                                    {{-- @endif --}}
                                </div>
                                
                            </div>
                            <div class="parent">
                                <div class="guest">
                                    Guest
                                </div>
                            </div>
                        </a>
                        <hr>
                        <div class="bookmarks px-5 py-4">
                            <div class="d-flex align-items-center user-profile">
                                <div class="profile">
                                    <i class="fas fa-bookmark" style="font-size: 1.5rem;"></i>
                                </div>
                                <div class="ms-3 name">
                                    <h5 class="font-bold">My Bookmarks</h5>
                                    <h6 class="text-muted mb-0">0 items</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Recent Messages</h4>
                        </div>
                        <div class="card-content pb-4">
                            <div class="recent-message d-flex user-profile px-4 py-3">
                                <div class="avatar profile avatar-lg">
                                    <img src="../images/profile.jpg">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">Hank Schrader</h5>
                                    <h6 class="text-muted mb-0">@johnducky</h6>
                                </div>
                            </div>
                            <div class="recent-message d-flex user-profile px-4 py-3">
                                <div class="avatar profile avatar-lg">
                                    <img src="../images/profile.jpg">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">Dean Winchester</h5>
                                    <h6 class="text-muted mb-0">@imdean</h6>
                                </div>
                            </div>
                            <div class="recent-message d-flex user-profile px-4 py-3">
                                <div class="avatar profile avatar-lg">
                                    <img src="../images/profile.jpg">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">John Dodol</h5>
                                    <h6 class="text-muted mb-0">@dodoljohn</h6>
                                </div>
                            </div>
                            <div class="px-4">
                                <button class='btn btn-block btn-xl btn-primary font-bold mt-3'>Start
                                    Conversation</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->

    @include('layouts.footer')
