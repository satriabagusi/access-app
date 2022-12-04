<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="logo w-100">
                <img src="{{asset('img/Pertamina_Logo.svg')}}" class="img-fluid w-100">
                <p class="small text-center mt-2 py-0" style="font-size: 15px;">Pertamina Fuel Terminal Cikampek</p>
            </div>
            <div class="d-flex justify-content-between align-items-center text-center w-100">
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2 text-center w-100">
                    <div class="d-inline-flex mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20"
                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                            <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                    opacity=".3"></path>
                                <g transform="translate(-210 -1)">
                                    <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                    <circle cx="220.5" cy="11.5" r="4"></circle>
                                    <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        &nbsp;
                        <div class="form-check form-switch fs-6">
                            <input class="form-check-input me-0" type="checkbox" id="toggle-dark"
                                style="cursor: pointer" onchange="setLogoSidebar()" />
                            <label class="form-check-label"></label>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">

                <li class="sidebar-item @yield('home')">
                    @if (Auth::user()->user_roles->user_role == "vendor")
                    <a href="{{URL::to('/vendor/home')}}" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Home</span>
                    </a>
                    @else
                    <a href="{{URL::to('/dashboard')}}" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Home</span>
                    </a>
                    @endif
                </li>

                @if (Auth::user()->user_role_id == 1 || Auth::user()->user_role_id == 2)
                <li class="sidebar-item @yield('daily-check-up')">
                    <a href="{{URL::to('/dashboard/input-dcu')}}" class='sidebar-link'>
                        <i data-feather="activity" width="20"></i>
                        <span>Daily Check Up</span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->user_role_id == 1 || Auth::user()->user_role_id == 3)
                <li class="sidebar-item @yield('safetytalk')">
                    <a href="{{URL::to('/dashboard/safetytalk')}}" class='sidebar-link'>
                        <i data-feather="check-circle" width="20"></i>
                        <span>Safetytalk</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->user_role_id == 1 || Auth::user()->user_role_id == 2)
                <li class="sidebar-item @yield('employee-data') has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="users" width="20"></i>
                        <span>Pegawai</span>
                    </a>
                    <ul class="submenu @yield('employee-data')">
                        <li>
                            <a class="@yield('list-employee')" href="{{URL::to('/dashboard/employee')}}">
                                Data Pegawai
                            </a>
                        </li>
                        <li>
                            <a class="@yield('add-employee')" href="{{URL::to('/dashboard/employee/add')}}">
                                Tambah Data Pegawai
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Auth::user()->user_role_id == 1)
                <li class="sidebar-item @yield('control-access') has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="key" width="20"></i>
                        <span>Akses</span>
                    </a>
                    <ul class="submenu @yield('control-access')">
                        <li>
                            <a class="@yield('list-department')" href="{{URL::to('/dashboard/department')}}">
                                Departemen
                            </a>
                        </li>
                        <li>
                            <a class="@yield('access-master')" href="{{URL::to('/dashboard/master-access-card')}}">
                                Kartu Akses Master
                            </a>
                        </li>
                        <li>
                            <a class="@yield('add-users')" href="{{URL::to('/dashboard/add-user')}}">
                                Akses Login
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Auth::user()->user_role_id == 1 || Auth::user()->user_role_id == 3)
                <li class="sidebar-item @yield('history') has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="clock" width="20"></i>
                        <span>History</span>
                    </a>
                    <ul class="submenu @yield('history')">
                        <li>
                            <a class="@yield('dcu-history')" href="{{URL::to('/dashboard/history/dcu')}}">
                                Daily Check Up
                            </a>
                        </li>
                        <li>
                            <a class="@yield('access-history')" href="{{URL::to('/dashboarad/history/access')}}">
                                Akses Area Terbatas
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Auth::user()->user_role_id == 1)
                <li class="sidebar-item @yield('vendor-permit') has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="clock" width="20"></i>
                        <span>Vendor Permit</span>
                    </a>
                    <ul class="submenu @yield('vendor-permit')">
                        <li>
                            <a class="@yield('vendor-data')" href="{{URL::to('dashboard/vendor/')}}">
                                Data Vendor
                            </a>
                        </li>
                        <li>
                            <a class="@yield('proyek-data')" href="{{URL::to('/dashboard/vendor/project')}}">
                                Data Proyek
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Auth::user()->user_role_id == 1)
                <li class="sidebar-item @yield('monitoring')">
                    <a href="{{URL::to('/dashboard/monitor/segel')}}" class='sidebar-link'>
                        <i data-feather="camera" width="20"></i>
                        <span>Monitoring Segel</span>
                    </a>
                </li>
                @endif

                </li>

                @if (Auth::user()->user_role_id == 4)

                <li class="sidebar-item @yield('vendor-project') has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="smartphone" width="20"></i>
                        <span>Pekerjaan</span>
                    </a>
                    <ul class="submenu @yield('vendor-project')">
                        <li>
                            <a class="@yield('project-list')" href="{{URL::to('/vendor/project-list')}}">
                                Data Pekerjaan
                            </a>
                        </li>
                        <li>
                            <a class="@yield('add-project')" href="{{URL::to('/vendor/add-project')}}">
                                Tambah Data Pekerjaan
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item @yield('vendor-detail') ">
                    <a href="{{URL::to('/vendor/profile')}}" class='sidebar-link'>
                        <i data-feather="user" width="20"></i>
                        <span>Profil Vendor</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>