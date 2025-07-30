<aside id="sidebar-left" class="sidebar-left">
    <div class="sidebar-header">
        <div class="sidebar-title">Admission Result Evaluation</div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html"
             data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li>
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="bx bx-home-alt" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{--Coordinator  Management--}}
                    <li class="nav-parent">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-user-tie" aria-hidden="true"></i>
                            <span>Coordinator Panel</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a class="nav-link" href="{{route('coordinator.examiner.assign')}}">
                                    Examiner Assign
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Examiner Management --}}
                    <li class="nav-parent">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                            <span>Examiner Panel</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a class="nav-link" href="{{ route('examiner.dashboard') }}">
                                    Start Entry
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('examiner.mark.entry') }}">
                                    Marks Entry
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- Report Management --}}
                    <li class="nav-parent">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                            <span>Report</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a class="nav-link" href="{{ route('report.english_mcq_pass') }}">
                                    English MCQ Pass Report
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('report.first_part_pass') }}">
                                    First Part Pass Report
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('report.missing_question') }}">
                                    Missing Question Report
                                </a>
                            </li>
                        </ul>
                    </li>



                    {{--Permission Management--}}
                    <li class="nav-parent">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-file-pdf"  aria-hidden="true"></i>
                            <span> Roles And Permission</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a class="nav-link" href="{{route('permission.all')}}">
                                    All Permission
                                </a>
                            </li>

                            <li>
                                <a class="nav-link" href="{{route('roles.all')}}">
                                    All Roles
                                </a>
                            </li>

                            <li>
                                <a class="nav-link" href="{{route('roles.permissions.add')}}">
                                    Roles in Permission
                                </a>
                            </li>

                            <li>
                                <a class="nav-link" href="{{route('roles.permission.all')}}">
                                    All Roles in Permission
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{--Role Assignment To Model(User)--}}
                    <li class="nav-parent">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-file-pdf"  aria-hidden="true"></i>
                            <span> Setting Admin User </span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a class="nav-link" href="{{route('user.all')}}">
                                    All User
                                </a>
                            </li>

                            <li>
                                <a class="nav-link" href="{{route('user.add')}}">
                                    Add User
                                </a>
                            </li>
                        </ul>
                    </li>



                </ul>
            </nav>
        </div>
        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>
    </div>
</aside>
