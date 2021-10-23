<nav class="navbar navbar-expand-md navbar-light shadow-sm mb-4 mb-lg-0 sidenav">
    <!-- Menu -->
    <a class="d-xl-none d-lg-none d-md-none text-inherit fw-bold" href="#">Menu</a>
    <!-- Button -->
    <button class="navbar-toggler d-md-none icon-shape icon-sm rounded bg-primary text-light" type="button"
        data-bs-toggle="collapse" data-bs-target="#sidenav" aria-controls="sidenav" aria-expanded="false"
        aria-label="Toggle navigation">
    <span class="fe fe-menu"></span>
    </button>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav">
        <div class="navbar-nav flex-column">
            <span class="navbar-header">Dashboard</span>
            <ul class="list-unstyled ms-n2 mb-4">
                <!-- Nav item -->
                <li class="nav-item" id="dashboard">
                    <a class="nav-link" href="/instructor/"><i class="fe fe-home nav-icon"></i>My
                    Dashboard</a>
                </li>
                <!-- Nav item -->
                <li class="nav-item" id="myCourses">
                    <a class="nav-link" href="/instructor/my-courses"><i class="fe fe-book nav-icon"></i>My Courses</a>
                </li>
                <!-- Nav item -->
                {{-- <li class="nav-item">
                    <a class="nav-link" href="/instructor/reviews"><i class="fe fe-star nav-icon"></i>Reviews</a>
                </li> --}}
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link" href="/instructor/students"><i class="fe fe-users nav-icon"></i>Students</a>
                </li>
            </ul>
            <!-- Navbar header -->
            <span class="navbar-header">Account Settings</span>
            <ul class="list-unstyled ms-n2 mb-0">
                <!-- Nav item -->
                <li class="nav-item" id="profile">
                    <a class="nav-link" href="/instructor/edit-profile"><i class="fe fe-settings nav-icon"></i>Edit Profile</a>
                </li>
                <!-- Nav item -->
                <li class="nav-item" id="security">
                    <a class="nav-link" href="/instructor/security"><i class="fe fe-user nav-icon"></i>Security</a>
                </li>
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link" href="/instructor/social-profiles"><i class="fe fe-refresh-cw nav-icon"></i>Social Profiles</a>
                </li>
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link" href="/instructor/logout"><i class="fe fe-power nav-icon"></i>Sign Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>