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

                    {{-- Roles And Permission --}}
                    @if(Auth::user()->can('role_permission.menu'))
                        <li class="nav-parent {{ request()->routeIs('permission.*') || request()->routeIs('roles.*') ? 'nav-expanded nav-active' : '' }}">
                            <a class="nav-link" href="#">
                                <i class="fa-solid fa-toolbox" aria-hidden="true"></i>
                                <span>Roles And Permission</span>
                            </a>
                            <ul class="nav nav-children">
                                @can('permission.all')
                                    <li>
                                        <a class="nav-link {{ request()->routeIs('permission.all') ? 'text-primary' : '' }}"
                                           href="{{ route('permission.all') }}">
                                            All Permission
                                        </a>
                                    </li>
                                @endcan
                                @can('roles.all')
                                    <li>
                                        <a class="nav-link {{ request()->routeIs('roles.all') ? 'text-primary' : '' }}"
                                           href="{{ route('roles.all') }}">
                                            All Roles
                                        </a>
                                    </li>
                                @endcan
                                @can('roles.permission.all')
                                    <li>
                                        <a class="nav-link {{ request()->routeIs('roles.permission.all') ? 'text-primary' : '' }}"
                                           href="{{ route('roles.permission.all') }}">
                                            All Roles in Permission
                                        </a>
                                    </li>
                                @endcan
                                @can('roles.permissions.add')
                                    <li>
                                        <a class="nav-link {{ request()->routeIs('roles.permissions.add') ? 'text-primary' : '' }}"
                                           href="{{ route('roles.permissions.add') }}">
                                            Roles in Permission
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    {{-- Role Assignment --}}
                    @if(Auth::user()->can('role_assign.menu'))
                        <li class="nav-parent {{ request()->routeIs('role.assignments.*') ? 'nav-expanded nav-active' : '' }}">
                            <a class="nav-link" href="#">
                                <i class="fa-solid fa-lock-open" aria-hidden="true"></i>
                                <span>Setting Admin User</span>
                            </a>
                            <ul class="nav nav-children">
                                @can('role.assignments.all')
                                    <li>
                                        <a class="nav-link {{ request()->routeIs('role.assignments.all') ? 'text-primary' : '' }}"
                                           href="{{ route('role.assignments.all') }}">
                                            All User
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endif



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
