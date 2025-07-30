<header class="header">
    <div class="logo-container">
        <a href="../4.3.0" class="logo">
            <img src="{{asset('upload/no_image.jpg')}}" width="75" height="35" alt="Porto Admin" />
        </a>
        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
    <!-- start: search & user box -->
    <div class="header-right">


        @php
            $id = Auth::user()->id;
            $userData = App\Models\User::find($id);
        @endphp
        {{--<span class="separator"></span>--}}
        <div id="userbox" class="userbox pt-2" style="width: 180px;">
            <a href="#" data-bs-toggle="dropdown" class="d-flex align-items-center justify-content-between">
                <div class="profile-info" data-lock-name="Admission" data-lock-email="johndoe@okler.com">
                    <span class="name">{{$userData->name}}</span>
                    {{--<span class="role">Administrator</span>--}}
                </div>
                <i class="fa custom-caret text-end"></i>
            </a>
            <div class="dropdown-menu">
                <ul class="list-unstyled mb-2">
                    <li>
                        <a role="menuitem" tabindex="-1" href="{{route('user.password.change')}}">
                            <i class="bx bx-user-circle fs-5 text-primary"></i>
                            <span>Change Password</span>
                        </a>
                    </li>

                    <li>
                        <a role="menuitem" tabindex="-1" href="{{route('user.logout')}}"> <i class="bx bx-power-off fs-5 text-danger"></i> Logout</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>
