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
    <link rel="stylesheet" href="{{asset('vendors/fontawesome/css/all.css')}}">

<style>
    body {
        font-family: 'Quicksand', sans-serif;
        background: #e0ebf3
    }
</style>

@stack('styles')

</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('vendors/jquery/jquery-3.6.0.js')}}"></script>
    <script src="{{asset('js/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

    {{-- <script src="{{asset('js/pages/dashboard.js')}}"></script> --}}
    <script src="{{asset('vendors/sweetalert2/js/sweetalert2.js')}}"></script>
    <!-- Include Choices JavaScript -->
    {{-- <script src="{{asset('vendors/bootstrap-select/js/bootstrap-select.js')}}"></script> --}}

    <script src="{{asset('js/script.js')}}"></script>

    <script src="{{asset('vendors/fontawesome/js/all.js')}}"></script>

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
