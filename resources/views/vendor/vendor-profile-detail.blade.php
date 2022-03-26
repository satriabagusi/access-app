@extends('layouts.dashboard')
@section('page-title', 'Profile Vendor')
@section('vendor-detail', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{route('update_vendor')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vendor_name">Nama Vendor</label>
                                <input type="text" class="form-control @error('vendor_name') is-invalid @enderror" id="vendor_name" placeholder="Nama Vendor" name="vendor_name" value="{{old('vendor_name', Auth::user()->vendors->vendor_name)}}" disabled>
                                @error('vendor_name')
                                        <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email Vendor</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Vendor" name="email" value="{{old('email', Auth::user()->vendors->email)}}" disabled>
                                @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" name="username" value="{{old('username', Auth::user()->username)}}" disabled>
                                @error('username')
                                        <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" value="{{old('password', Auth::user()->password)}}" disabled>
                                @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="float-end mt-3">
                        <button id="editBtn" type="button" class="btn btn-primary">Ubah Profil Vendor</button>
                        <button id="submitBtn" type=submit class="btn btn-primary">Update Profil Vendor</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('#submitBtn').hide();
        $('#editBtn').click(function(e){
            e.preventDefault();
            $('#vendor_name').prop("disabled", false);
            $('#email').prop("disabled", false);
            $('#username').prop("disabled", false);
            $('#password').prop("disabled", false);
            $('#editBtn').hide();
            $('#submitBtn').show();
        })
    })
</script>
@endpush
