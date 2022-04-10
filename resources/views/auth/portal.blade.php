@extends('layouts.app')
@section('title', 'FT Pertamina Cikampek - Login')

@section('content')
<div class="row justify-content-center" style="margin-top: 120px;">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="row justify-content-center mt-5 mb-5">
                            <div class="col-9">
                                <img class="img-fluid mt-3" src="{{asset('img/Pertamina_Logo.svg')}}" alt="" srcset="">
                                <h5 class="text-center text-bold mt-4">Fuel Terminal Pertamina Cikampek</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-lg-none mt-4 text-center">
                            <img width="200px" class="img-fluid mt-3" src="{{asset('img/Pertamina_Logo.svg')}}" alt="" srcset="">
                            <h5 class="text-center text-bold mt-1">Fuel Terminal Pertamina Cikampek</h5>
                            <hr>
                        </div>
                        <div class="py-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Login</h1>
                            </div>
                        <div class="row mb-2 justify-content-center">
                            <div class="col-9 text-center">
                                <a href="{{url('/vendor/login')}}" class="btn btn-sm btn-warning">Login Sebagai Vendor</a>
                                <a href="{{url('/login')}}" class="btn btn-sm btn-primary">Login Sebagai Admin</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection
