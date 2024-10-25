<li class="nav-item">
    <a class="nav-link" href="{{ url('/dashboard') }}">
        <i class="bi bi-grid" style="font-size: 20px;"></i><span>Overview</span>
    </a>
</li><!-- End Dashboard Nav -->

<!-- Janani Moms -->
<li class="nav-item has-sub">
    <a href="#" class='nav-link collapsed' data-bs-target="#janani-moms-nav" data-bs-toggle="collapse">
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
    <a href="#" class='nav-link collapsed' data-bs-target="#pregnancy-classes-nav" data-bs-toggle="collapse">
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
    <a class="nav-link" href="#">
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
