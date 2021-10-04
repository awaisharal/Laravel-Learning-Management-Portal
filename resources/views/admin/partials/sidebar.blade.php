<nav class="navbar-vertical navbar">
    <div class="nav-scroller">
        <a class="navbar-brand" href="/index.html">
            <img src="/assets/images/brand/logo/logo-inverse.svg" alt="" />
        </a>
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link" href="/admin">
                    <i class="nav-icon fe fe-home me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navinstructor" aria-expanded="false" aria-controls="navinstructor">
                    <i class="nav-icon fe fe-users me-2"></i> Instructors
                </a>
                <div id="navinstructor"  class="collapse "  data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="/admin/all-instructors">
                                All Instructors
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/admin/add-instructors">
                                Add Instructors
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navstudents" aria-expanded="false" aria-controls="navstudents">
                    <i class="nav-icon fe fe-user me-2"></i> Students
                </a>
                <div id="navstudents"  class="collapse "  data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="/admin/all-students">
                                All Students
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/admin/add-students">
                                Add Students
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navCourses" aria-expanded="false" aria-controls="navCourses">
                    <i class="nav-icon fe fe-book me-2"></i> Courses
                </a>
                <div id="navCourses"  class="collapse "  data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="/admin/all-courses">
                                All Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/admin/courses-categories">
                                Courses Categories
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>
        </ul>
    </div>
</nav>