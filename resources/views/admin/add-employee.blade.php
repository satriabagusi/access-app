@extends('layouts.dashboard')
@section('page-title', 'Data Pegawai')
@section('employee-data', 'active')
@section('add-employee', 'text-primary')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Pegawai</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form id="add_employee" action="{{route('add-employee')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6">
                            <div class="form-group has-icon-right">
                                <label for="uuid_card">Nomor Kartu </label>
                                <div class="position-relative">
                                    <input type="text" id="uuid_card" class="form-control @error('uuid_card') is-invalid @enderror" placeholder="Nomor Kartu" name="uuid_card" value="{{old('uuid_card')}}" autocomplete="off" autofocus>
                                    <button id="btnRemove" type="button" class="btn btn-sm btn-circle btn-danger form-control-icon" style="margin-right: 10px;">
                                        X
                                    </button>
                                </div>
                                @error('uuid_card')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>

                            <div class=" col-md-6 form-group">
                                <label>Nomor Pegawai</label>
                                <input type="text" placeholder="Nomor Pegawai"
                                    class="form-control @error('employee_number') is-invalid @enderror" autofocus
                                    name="employee_number" maxlength="12" value="{{old('employee_number')}}"
                                    id="employee_number">
                                @error('employee_number') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nama Pegawai</label>
                                <input type="text" placeholder="Nama Pegawai"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{old('name')}}" id="name">
                                @error('name') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Departemen</label>
                                <select class="form-select @error('department_id') is-invalid @enderror"
                                    aria-label="Department" name="department_id" id="department_id">
                                    @foreach ($department as $item)
                                    <option value="{{$item->id}}">{{$item->department}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Bagian/Fungsi</label>
                                <input type="text" placeholder="Bagian/Fungsi"
                                    class="form-control @error('division') is-invalid @enderror" name="division"
                                    value="{{old('division')}}" id="division">
                                @error('division') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Perusahaan</label>
                                <input type="text" placeholder="Nama Perusahaan"
                                    class="form-control @error('company') is-invalid @enderror" name="company"
                                    value="{{old('company')}}" id="company">
                                @error('company') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tambah Data Pegawai</span>
                    </button>
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
        $('#add_employee').on('keyup keypress', function (e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

        var timer = null;
        $('#uuid_card').on('keyup', function (e) {
            clearTimeout(timer);
            timer = setTimeout(parseDec, 45);
        });

        function parseDec() {
            var uid_parse = parseInt($('#uuid_card').val(), 10).toString(16);
            if (uid_parse.length > 7) {
                uid_parse = uid_parse.substr(2, 8);
                if (uid_parse.charAt(0) == 0) {
                    uid_parse = uid_parse.substring(1);
                }
            } else if (uid_parse.length < 8) {
                uid_parse = uid_parse.slice(1, 7);
            }
            $('#uuid_card').val(uid_parse);
        }

        $('#btnRemove').on('click', function(e){
            $('#uuid_card').val("");
        });


        $('#employee_number').mask('000000000000');
    });

</script>

@endpush
