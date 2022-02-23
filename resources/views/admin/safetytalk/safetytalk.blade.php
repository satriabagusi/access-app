@extends('layouts.dashboard')
@section('page-title', 'Safetytalk Check')
@section('safetytalk', 'active')

@section('content')

<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Safetytalk Check</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form id="dcu_input" action="{{route('SafetytalkCheck')}}" method="post">
                    <div class="row">
                        <h5>Data Pegawai</h5>
                        <br>
                            @csrf
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
                        <div class="col-12 col-md-6 dcu-form d-none">
                            <div class="form-group">
                                <label for="employee_name">Nama Pegawai</label>
                                <input type="text" id="employee_name" class="form-control @error('employee_name') is-invalid @enderror" placeholder="Nama Pegawai" name="employee_name" value="{{old('employee_name')}}" readonly>
                                @error('employee_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 dcu-form d-none">
                            <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" id="department" class="form-control @error('department') is-invalid @enderror" placeholder="Department"  value="{{old('department')}}" readonly>
                                @error('department')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 dcu-form d-none">
                            <div class="form-group">
                                <label for="employee_number">Nomor Pegawai</label>
                                <input type="text" id="employee_number" class="form-control @error('employee_number') is-invalid @enderror" placeholder="Nomor Pegawai"  value="{{old('employee_name')}}" readonly>
                                @error('employee_number')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                    <i data-feather="check-circle" width="20"></i>
                                    Check Safetytalk
                                </button>
                            </div>

                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){

            // JQUERY MASK
            $('#blood_pressure').mask('000/00');
            $('#temperature').mask('00,00');

            //DISABLE ENTER KEY

            $('#dcu_input').on('keyup keypress', function(e){
                var keyCode = e.keyCode || e.which;
                if(keyCode === 13){
                    e.preventDefault();
                    return false;
                }
            });

            $('#btnRemove').on('click', function(e){
                $('#uuid_card').val("");
                $('#employee_name').val("");
                $('#employee_number').val("");
                $('#department').val("");
                $('.dcu-form').addClass('d-none');
                $('#uuid_card').focus();
            });

        var timer = null;
        $('#uuid_card').on('keyup', function (e) {
            clearTimeout(timer);
            timer = setTimeout(parseDec, 100);
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
            if(uid_parse !== ""){
                getEmployee();
            }
        }

        function getEmployee(){
            var uuid_card = $('#uuid_card').val();
            if(uuid_card !== ""){
                    $.ajax({
                        type: 'GET',
                        url: "{{URL::to('/data/dcu/employee')}}",
                        data: {'uuid_card': uuid_card},
                        dataType: 'json',
                        success: function(data){
                            if(data.status == 403 || data.status == 404){
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Pegawai belum terdaftar pada Database.',
                                    icon: 'error',
                                    confirmButtonColor: '#5a8dee'
                                })
                            }else if(data.status == 200){
                                console.log(data);
                                $('#checkEmployee').addClass('d-none');
                                $('#employee_name').val(data.data.name);
                                $('#employee_number').val(data.data.employee_number);
                                $('#department').val(data.data.departments.department);
                                $('.dcu-form').removeClass('d-none');
                            }
                        },
                        error: function(response){
                            console.log(response.responseJSON.message);
                        }
                    });
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: 'Harap mengisi nomor kartu',
                        icon: 'error',
                        confirmButtonColor: '#5a8dee'
                    })
                }
        }

        $('#uuid_card').on('change', function (e) {
            $.get('')
        })

        });
    </script>
@endpush
