@extends('layouts.app')
@section('title', 'DCU - Login')

@section('content')
<div class="row justify-content-center" style="margin-top: 120px;">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="row justify-content-center mt-5">
                            <div class="col-9">
                                <img class="img-fluid mt-3" src="{{asset('img/Pertamina_Logo.svg')}}" alt="" srcset="">
                                <h5 class="text-center text-bold mt-4">Fuel Terminal Pertamina Ujung Berung</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Login</h1>
                            </div>
                            <form class="user" method="POST" action="{{route('login-post')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control form-control-user"
                                    id="username" aria-describedby="usernameHelp"
                                        placeholder="Username" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control form-control-user"
                                        id="password" name="password" placeholder="Password">
                                </div>
                                <button class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection
