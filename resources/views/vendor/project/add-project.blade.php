@extends('layouts.dashboard')
@section('page-title', 'Vendor Dashboard')
@section('vendor-project', 'active')
@section('add-project', 'text-primary')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{route('add_project')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project_name">Nama Pekerjaan</label>
                                <input type="text" class="form-control @error('project_name') is-invalid @enderror" id="project_name" placeholder="Nama Pekerjaan" name="project_name" value="{{old('project_name')}}">
                                @error('project_name')
                                        <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="contract_number">Nomor Kontrak</label>
                                <input type="text" class="form-control @error('contract_number') is-invalid @enderror" id="contract_number" placeholder="Nomor Kontrak" name="contract_number" value="{{old('contract_number')}}">
                                @error('contract_number')
                                        <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contract_start">Tanggal Mulai Pekerjaan</label>
                                <input type="date" class="form-control @error('contract_start') is-invalid @enderror" id="contract_start" placeholder="Tanggal Mulai Pekerjaan" name="contract_start" value="{{old('contract_start')}}">
                                @error('contract_start')
                                        <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="contract_end">Tanggal Berakhir Pekerjaan</label>
                                <input type="date" class="form-control @error('contract_end') is-invalid @enderror" id="contract_end" placeholder="Tanggal Mulai Pekerjaan" name="contract_end" value="{{old('contract_end')}}">
                                @error('contract_end')
                                        <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="float-end mt-3">
                        <button type="submit" class="btn btn-primary">Tambah Kontrak Pekerjaan</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection
