@extends('layouts.dashboard')
@section('page-title', 'Tambah Departemen')
@section('control-access', 'active')
@section('list-department', 'text-primary')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Departemen</h4>
            </div>
                <div class="card-content">
                    <div class="card-body">

                        <form action="{{route('add-department')}}" method="post">
                            <div class="row">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nama_departemen">Nama Departemen</label>
                                        <input type="text" class="form-control @error('department')
                                            is-invalid
                                        @enderror" name="department" id="nama_departemen" placeholder="Nama Departemen" value="{{old('department')}}">
                                    </div>
                                    @error('department')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                    </div>

                <div class="card-footer bg-white">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </form>

                </div>
                </div>
            </div>
        </div>
</div>

@endsection

@push('scripts')

@endpush
