<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="shortcut icon" href="{{asset('images/favicon.svg')}}" type="image/x-icon">
    {{-- <link rel="stylesheet" src="{{asset('vendors/bootstrap-select/css/bootstrap-select.css')}}"> --}}

    <link rel="stylesheet" href="{{asset('vendors/sweetalert2/css/sweetalert2.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/datetimepicker/css/tempus-dominus.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/datetimepicker/css/daterangepicker.css')}}">

    <style>
        body {
            font-family: 'Quicksand', sans-serif !important;
            background: #e0ebf3
        }
    </style>
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="{{asset('img/Pertamina_Logo.svg')}}" >
                    <p class="small text-center mt-2" style="font-size: 14px;">Pertamina Fuel Terminal Ujung Berung</p>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">


                        <li class="sidebar-item @yield('home') ">
                            <a href="{{URL::to('/dashboard')}}" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Home</span>
                            </a>
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
                        {{-- <li class="sidebar-item @yield('employee-data')">
                            <a href="{{URL::to('/dashboard/employee')}}" class='sidebar-link'>
                                <i data-feather="users" width="20"></i>
                                <span>Data Pegawai</span>
                            </a>
                        </li> --}}
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
                                    <a class="@yield('access-history')" href="{{URL::to('/dashboard/department')}}">
                                        Akses Area Terbatas
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>



        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">

                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-2 bg-info">
                                    <i data-feather="user" class="text-white" ></i>
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi, {{Auth::user()->username}}</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item"> Welcome, {{Auth::user()->username}}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{URL::to('/logout')}}"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>@yield('page-title')</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <section class="section">
                    @yield('content')
                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2020 &copy; DCU Apps</p>
                    </div>
                    <div class="float-end">
                        <p>Made by <a
                                href="https://instagram.com/movetech.id">Move Tech ID</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{asset('vendors/jquery/jquery-3.6.0.js')}}"></script>
    <script src="{{asset('vendors/moment/moment.min.js')}}"></script>
    <script src="{{asset('js/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    {{-- <script src="{{asset('js/bootstrap.bundle.js')}}"></script> --}}
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

    {{-- <script src="{{asset('js/pages/dashboard.js')}}"></script> --}}
    <script src="{{asset('vendors/sweetalert2/js/sweetalert2.js')}}"></script>
    <!-- Include Choices JavaScript -->
    {{-- <script src="{{asset('vendors/bootstrap-select/js/bootstrap-select.js')}}"></script> --}}

    <script src="{{asset('js/script.js')}}"></script>

    <script src="{{asset('vendors/jquery-mask/jquery.mask.js')}}"></script>
    <script src="{{asset('vendors/datetimepicker/js/tempus-dominus.js')}}"></script>
    <script src="{{asset('vendors/datetimepicker/js/daterangepicker.js')}}"></script>


    @stack('scripts')


    @if (session()->has('success'))
        <script>
            Toast.fire({
                icon: 'success',
                title: '{{session()->get('success')}}'
            })
        </script>
    @elseif(session()->has('error'))
        <script>
            Toast.fire({
                icon: 'error',
                title: '{{session()->get('error')}}'
            })
        </script>
    @endif


</body>

</html>
