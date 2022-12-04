@extends('layouts.dashboard')
@section('page-title', 'Tambah Akses Login')
@section('control-access', 'active')
@section('add-user', 'text-primary')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Akses Login</h4>
            </div>
            <div class="card-content">
                <form id="addUser" action="{{route('addUser')}}" method="post">
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    placeholder="Username" name="username" value="{{old('username')}}">
                                @error('username')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="password" name="password" value="{{old('password')}}">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-check form-check-inline">
                                <label for="" class="">Jenis User</label>
                                <div class="row justify-content-evenly">
                                    <div class="col-auto">
                                        <input class="form-check-input @error('user_role_id') is-invalid @enderror"
                                            type="radio" name="user_role_id" id="user_role_id1" value="1">
                                        <label class="form-check-label" for="user_role_id1">Admin</label>
                                    </div>
                                    <div class="col-auto">
                                        <input class="form-check-input @error('user_role_id') is-invalid @enderror"
                                            type="radio" name="user_role_id" id="user_role_id2" value="2">
                                        <label class="form-check-label" for="user_role_id2">Admin DCU</label>
                                    </div>
                                    <div class="col-auto">
                                        <input class="form-check-input @error('user_role_id') is-invalid @enderror"
                                            type="radio" name="user_role_id" id="user_role_id3" value="3">
                                        <label class="form-check-label" for="user_role_id3">Admin Safetytalk</label>
                                    </div>
                                </div>
                                @error('user_role_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="card-footer text-end">
                        <a class="btn btn-sm btn-secondary"
                            href="{{URL::to('/dashboard/master-access-card')}}">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {

    });

</script>
@endpush