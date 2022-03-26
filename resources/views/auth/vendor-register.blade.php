@extends('layouts.app')
@section('title', 'DCU - Login')

@section('content')
<div class="row justify-content-center" style="margin-top: 120px;">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-header">
                <div class="row justify-content-center">
                    <div class="col-5">
                        <img class="img-fluid mt-1" src="{{asset('img/Pertamina_Logo.svg')}}" alt="" srcset="">
                        <h5 class="text-center text-bold mt-4">Fuel Terminal Pertamina Cikampek</h5>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <hr>
                    </div>
                </div>
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <h1 class="h4 text-gray-900 mb-4 text-center">Register Vendor</h1>
                    <form class="user" method="POST" action="{{route('register-vendor')}}">
                        @csrf
                        <div class="row p-4">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                        name="username" value="{{old('username')}}">
                                    @error('username')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                        name="password">
                                    @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="namaVendor">Nama Vendor</label>
                                    <input type="text" id="namaVendor" class="form-control @error('vendor_name') is-invalid @enderror" placeholder="Nama Vendor"
                                        name="vendor_name" value="{{old('vendor_name')}}">
                                    @error('vendor_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email Vendor</label>
                                    <input type="email" id="email" class="form-control @error('vendor_email') is-invalid @enderror" placeholder="vendor@email.com"
                                        name="vendor_email" value="{{old('vendor_email')}}">
                                    @error('vendor_email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-end">
                            <a href="{{url('/')}}" class="btn btn-outline-warning mr-2">Kembali</a>
                            <button class="btn btn-primary btn-user">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection
