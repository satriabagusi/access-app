@extends('layouts.dashboard')
@section('page-title', 'Vendor Dashboard')
@section('vendor-project', 'active')
@section('project-list', 'text-primary')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{route('update_contract')}}" method="POST">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" value="{{$project->id}}">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project_name">Nama Pekerjaan</label>
                                <input type="text" class="form-control @error('project_name') is-invalid @enderror" id="project_name" placeholder="Nama Pekerjaan" name="project_name" value="{{old('project_name', $project->project_name)}}" disabled>
                                @error('project_name')
                                        <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="contract_number">Nomor Kontrak</label>
                                <input type="text" class="form-control @error('contract_number') is-invalid @enderror" id="contract_number" placeholder="Nomor Kontrak" name="contract_number" value="{{old('contract_number', $project->contract_number)}}" disabled>
                                @error('contract_number')
                                        <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contract_start">Tanggal Mulai Pekerjaan</label>
                                <input type="date" class="form-control @error('contract_start') is-invalid @enderror" id="contract_start" placeholder="Tanggal Mulai Pekerjaan" name="contract_start" value="{{old('contract_start', $project->contract_start)}}" disabled>
                                @error('contract_start')
                                        <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="contract_end">Tanggal Berakhir Pekerjaan</label>
                                <input type="date" class="form-control @error('contract_end') is-invalid @enderror" id="contract_end" placeholder="Tanggal Mulai Pekerjaan" name="contract_end" value="{{old('contract_end', $project->contract_end)}}" disabled>
                                @error('contract_end')
                                        <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="float-end mt-3">
                        <button id="editBtn" type="button" class="btn btn-outline-primary">
                            <i data-feather="edit"></i>
                            Edit Data Kontrak
                        </button>
                        <button id="submitBtn" type="submit" class="btn btn-primary">
                            <i data-feather="check-circle"></i>
                            Update Data Kontrak
                        </button>
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
            $('#project_name').prop("disabled", false);
            $('#contract_number').prop("disabled", false);
            $('#contract_start').prop("disabled", false);
            $('#contract_end').prop("disabled", false);
            $('#editBtn').hide();
            $('#submitBtn').show();
        })
    })
</script>
@endpush
