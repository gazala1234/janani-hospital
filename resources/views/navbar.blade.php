<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
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
    .hospital-logo {
        max-width: 100%;
        height: auto;
        padding: 0 10px;
        margin: 10px 0;
    }
</style>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <!-- start Logo -->
        <div class="d-flex align-items-center justify-content-between p-3">
            <a href="{{ url('/') }}">
                <img src="../images/janani-logo.png" class="hospital-logo" alt="Logo" srcset="">
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <!-- End Logo -->
    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav mt-4" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="bi bi-grid" style="font-size: 20px;"></i><span>Overview</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <!-- Janani Moms -->
            <li class="nav-item has-sub">
                <a href="#" class='nav-link collapsed' data-bs-target="#janani-moms-nav"
                    data-bs-toggle="collapse">
                    <i class="bi bi-people" style="font-size: 20px;"></i><span>Janani Moms</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="janani-moms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li><a href="{{ url('api/ask-suggestion') }}"></i><span>Ask for suggestions</span></a></li>
                    <li><a href="{{ url('api/book-consult') }}"><span>Book a consult</span></a></li>
                    <li><a href="{{ url('api/ask-doctor') }}"><span>Ask an expert</span></a></li>
                    <li><a href="{{ url('api/baby-shower') }}"><span>Virtual baby shower</span></a></li>
                    <li><a href="{{ url('api/introduce-yourself') }}"><span>Introduce yourself</span></a></li>
                </ul>
            </li><!-- End Janani Moms -->

            <!-- Pregnancy Classes -->
            <li class="nav-item has-sub">
                <a href="#" class='nav-link collapsed' data-bs-target="#pregnancy-classes-nav"
                    data-bs-toggle="collapse">
                    <i class="bi bi-person-badge" style="font-size: 20px;"></i><span>Pregnancy Classes</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="pregnancy-classes-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li><a href="{{ url('api/ask-suggestion') }}"><span>Ask for suggestions</span></a></li>
                </ul>
            </li><!-- End Pregnancy Classes -->

            <!-- Pregnancy Packages -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-box2" style="font-size: 20px;"></i><span>Pregnancy Packages</span>
                </a>
            </li><!-- End Pregnancy Packages -->

            <!-- Janani Health Cards -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-card-list" style="font-size: 20px;"></i><span>Janani Health Cards</span>
                </a>
            </li><!-- End Janani Health Cards -->

            <!-- Live Sessions -->
            <li class="nav-item">
                <a class="nav-link" href="table.html">
                    <i class="bi bi-camera-video" style="font-size: 20px;"></i><span>Live Sessions</span>
                </a>
            </li><!-- End Live Sessions -->

            <!-- Events -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('api/events') }}">
                    <i class="bi bi-calendar2-event" style="font-size: 20px;"></i><span>Events</span>
                </a>
            </li><!-- End Events -->

            <!-- Services -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('api/services') }}">
                    <i class="bi bi-info-circle" style="font-size: 20px;"></i><span>Services</span>
                </a>
            </li><!-- End Services -->

            <!-- Settings -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('api/settings') }}">
                    <i class="bi bi-gear" style="font-size: 20px;"></i><span>Settings</span>
                </a>
            </li><!-- End Settings -->

        </ul>
    </aside>

    <!-- End Sidebar-->


    <main id="main" class="main">

        {{-- dashboard content will come here --}}
        <section class="section dashboard" id="section">
            @yield('maincontent')
        </section>

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            Copyright &copy; 2024 <strong>Janani MultiSpeciality Hospital.</strong>
        </div>
        <div class="credits">
            Made With ❤ <a href="https://bootstrapmade.com/"> Medya Web Technologies</a>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/chart.umd.js') }}"></script>
    <script src="{{ asset('js/echarts.min.js') }}"></script>
    <script src="{{ asset('js/quill.js') }}"></script>
    <script src="{{ asset('js/simple-datatables.js') }}"></script>
    <script src="{{ asset('js/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/mainjs/main.js') }}"></script>

</body>

</html>
