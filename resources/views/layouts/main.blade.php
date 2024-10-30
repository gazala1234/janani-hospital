<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    /* CSS for small mobile screens */
    @media (max-width: 320px) {
        .small-btn {
            font-size: 0.8rem;
            padding: 0.3rem 0.6rem;
        }

        .small-icon {
            font-size: 1.2rem;
        }

        .header {
            padding: 1rem;
        }
    }

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
    <header id="header" class="header fixed-top d-flex align-items-center p-3">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between w-100">
                <!-- Logo Section -->
                <div class="d-flex col-md-2 justify-content-center">
                    <a href="{{ url('/api/dashboard') }}">
                        <img src="../images/janani-logo.png" class="hospital-logo" alt="Logo">
                    </a>
                </div>

                <!-- Sidebar Toggle Section -->
                <div class="col-1">
                    <i class="bi bi-list toggle-sidebar-btn small-icon"></i> <!-- Added small-icon class -->
                </div>

                <!-- Sidebar Toggle and Title Section -->
                <div class="d-flex flex-grow-1 align-items-center justify-content-center text-center">
                    <h3 class="my-0 d-none d-md-block">JANANI - MULTISPECIALITY HOSPITAL</h3> <!-- Hidden on mobile -->
                </div>

                <!-- Signin and Profile Sections -->
                <div class="d-flex align-items-center">
                    @if (!session()->has('role'))
                        <div class="me-3">
                            <a href="{{ url('/') }}" class="text-decoration-none me-3">
                                <button type="button" class="btn btn-outline-primary small-btn">Signin</button>
                            </a>
                        </div>
                    @else
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none"
                                id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../images/profile.jpg" alt="Profile Logo" class="rounded-circle"
                                    width="60" height="60">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ url('api/profile') }}">
                                        <i class="bi bi-person-circle me-2"></i> View Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('api/settings') }}">
                                        <i class="bi bi-gear me-2"></i> Settings
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" id="signoutButton" href="javascript:void(0);">
                                        <i class="bi bi-box-arrow-right me-2"></i> Signout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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
                    window.location.href = "{{ url('/') }}"; // Redirect to login page
                } else {
                    throw error;
                }
            }
        }
    </script>

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
                            <a href="{{ url('api/profile') }}">
                                <div class="align-items-center user-profile text-center">
                                    <div class="avatar profile avatar-xl">
                                        <img src="../images/profile.jpg" alt="User">
                                    </div>
                                    @php
                                        $role = session('role');
                                        $userDetails = session('userDetails');
                                    @endphp

                                    <div class="ms-3 name">
                                        <h5 class="font-bold">
                                            {{ $role
                                                ? (($userDetails['fname'] ?? null) && ($userDetails['lname'] ?? null)
                                                    ? $userDetails['fname'] . ' ' . $userDetails['lname']
                                                    : 'Patient')
                                                : 'Guest' }}
                                        </h5>
                                        <h6 class="text-muted mb-0">
                                            {{ $userDetails['email'] ?? '@guestmail' }}
                                        </h6>
                                    </div>
                                </div>
                                <div class="parent mt-3">
                                    <div class="guest">
                                        {{ session('role') != null ? session('role') : 'Guest' }}
                                    </div>
                                </div>
                            </a>
                            <hr>
                            <div class="bookmarks px-3 py-4">
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


    <script>
        $(document).ready(function() {
            $('#signoutButton').on('click', function() {
                $.ajax({
                    type: 'POST',
                    url: '/api/logout',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            // alert(response.message);
                            window.location.href =
                                "{{ url('/') }}";
                        } else {
                            alert('Logout failed. Please try again.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Logout failed. Please try again.');
                    }
                });
            });
        });
    </script>
    @yield('js_scripts')

    @include('layouts.footer')
