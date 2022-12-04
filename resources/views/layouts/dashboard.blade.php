<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('page-title')</title>

    <link rel="stylesheet" href="{{asset('assets/css/main/app.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/main/app-dark.css')}}" />
    <link rel="shortcut icon" href="{{asset('images/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('images/favicon.svg')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('assets/css/shared/iconly.css')}}" />

    <link rel="stylesheet" href="{{asset('vendors/sweetalert2/css/sweetalert2.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/datetimepicker/css/tempus-dominus.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/datetimepicker/css/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/bs-stepper/css/bs-stepper.css')}}" />
    <link rel="stylesheet" href="{{asset('vendors/dropzone/css/dropzone.min.css')}}" />
    <link rel="stylesheet" href="{{asset('vendors/filepond/css/filepond.css')}}">

    <link rel="stylesheet" href="{{asset('css/styles.css')}}" />
</head>

<body>
    <script>
        (()=>{var e=document.body;"theme-dark"==localStorage.getItem("theme")?e.classList.add("theme-dark"):e.classList.add("theme-light")})();
    </script>
    <div id="app">
        @include('partials.sidebar')
        <div id="main">
            @include('partials.navbar')

            <div class="page-heading">
                <h3>@yield('page-title')</h3>
                {{-- <p class="text-subtitle text-muted"></p> --}}
            </div>
            <div class="page-content">
                @yield('content')
            </div>
            @include('partials.footer')
        </div>
    </div>
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    {{-- add on --}}
    <script src="{{asset('vendors/jquery/jquery-3.6.0.js')}}"></script>
    <script src="{{asset('vendors/moment/moment.min.js')}}"></script>
    <script src="{{asset('js/feather-icons/feather.min.js')}}"></script>
    {{-- <script src="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script> --}}
    <script src="{{asset('js/app.js')}}"></script>
    {{-- <script src="{{asset('js/main.js')}}"></script> --}}

    <script src="{{asset('vendors/sweetalert2/js/sweetalert2.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>

    <script src="{{asset('vendors/jquery-mask/jquery.mask.js')}}"></script>
    <script src="{{asset('vendors/datetimepicker/js/tempus-dominus.js')}}"></script>
    <script src="{{asset('vendors/datetimepicker/js/daterangepicker.js')}}"></script>
    <script src="{{asset('vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/datatables/dataTables.bootstrap.min.js')}}"></script>

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
    <script>
        $(document).ready(function(){
            setLogoSidebar();
        });

        setLogoSidebar = () => {
            let img = $('div.logo').find('img');
            if($('#toggle-dark').prop('checked')){
                img.attr('src', "{{ asset('img/Pertamina_Logo_White.png') }}");
            }else{
                img.attr('src', "{{ asset('img/Pertamina_Logo.svg') }}");
            }
        }

        dropdownNavbar = (self) => {
            if($(self).hasClass('show')){
                $(self).removeClass('show');
                $(self).parents('.dropdown').find('.dropdown-menu').removeClass('show');
            }else{
                $(self).addClass('show');
                $(self).parents('.dropdown').find('.dropdown-menu').addClass('show');
            }
        }
    </script>
</body>

</html>