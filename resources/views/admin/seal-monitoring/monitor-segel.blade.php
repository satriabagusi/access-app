@extends('layouts.dashboard')
@section('page-title', 'Monitoring Segel Kendaraan')
@section('monitoring', 'active')

@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-body">
                @if ($camera->isEmpty())
                <div class="text-center">
                    <h4 class="mb-3">Kamera belum didaftarkan.</h4>
                    <img width="200px" src="{{asset('img/no-data.png')}}" alt="" class="img-fluid">
                </div>
                @else
                <h4>Data Kamera Monitor</h4>
                <hr>
                <label for="gateNumber">Gate Number</label>
                <fieldset class="form-group">
                    <select class="form-select" id="gateNumber">
                        @foreach ($camera as $item)
                        <option value="{{$item->id}}">{{$item->gate_number}}</option>
                        @endforeach
                    </select>
                </fieldset>
                <div class="row mt-4">
                    <div class="col-6">
                        <p>Segel Atas</p>
                        <img class="img-fluid" src="{{\Storage::url('capture_seal/picture.jfif')}}" name="refresh" />
                        <p class="text-black-50 text-center mt-2">IP : 192.168.100.1</p>
                    </div>
                    <div class="col-6">
                        <p>Segel Samping</p>
                        <img class="img-fluid" src="{{\Storage::url('capture_seal/picture.jfif')}}" name="refresh" />
                        <p class="text-black-50 text-center mt-2">IP : 192.168.100.1</p>
                    </div>
                </div>
                <div class="row mt-4 justify-content-end">
                    <div class="col-md-5 col-12">
                        <a href="#" class="btn btn-sm btn-outline-info mb-2">
                            <i data-feather="edit"></i>
                            Edit Kamera
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-danger mb-2">
                            <i data-feather="x-circle"></i>
                            Hapus
                        </a>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-auto">
                        <p>Segel Atas</p>
                        <img src="http://192.168.100.15/ISAPI/Streaming/channels/102/httpPreview" name="refresh" />
                    </div>
                    <div class="col-auto">
                        <p>Segel Samping</p>
                        <img src="http://192.168.100.15/ISAPI/Streaming/channels/102/httpPreview" name="refresh" />
                    </div>
                </div> --}}
                @endif
                {{-- <div class="mt-5 border-top"> --}}
                    {{-- </div> --}}
            </div>
            <div class="card-footer text-end">
                <button type="button" id="btnAdd" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addCamera">
                    <i data-feather="plus-circle"></i>
                    Tambah Kamera Monitor
                </button>
            </div>
        </div>
    </div>
</div>

<!--Modal -->
<div class="modal fade text-left" id="addCamera" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Tambah Kamera Segel </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{route('addCamera')}}" method="POST">
                <div class="modal-body">
                    @csrf
                    <label>Nomor Gate: </label>
                    <div class="form-group">
                        <input name="gate_number" id="gate_number" type="text" placeholder="Nomor Gate"
                            class="@error('gate_number')is-invalid @enderror form-control">
                        @error('gate_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label>IP Kamera Atas: </label>
                    <div class="form-group">
                        <input name="ip_camera_top" id="camera_top" type="text" placeholder="IP Kamera Atas"
                            class="@error('ip_camera_top')is-invalid @enderror form-control">
                        @error('ip_camera_top')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label>IP Kamera Samping: </label>
                    <div class="form-group">
                        <input name="ip_camera_side" id="camera_side" type="text" placeholder="IP Kamera Bawah"
                            class="@error('ip_camera_side')is-invalid @enderror form-control">
                        @error('ip_camera_side')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Batal</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">
                            <i data-feather="plus-square"></i>
                            Tambah
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#gate_number').mask('00');
        $('#camera_top').mask('099.099.099.099');
        $('#camera_side').mask('099.099.099.099');

        // var image = "http://192.168.100.15/ISAPI/Streaming/channels/102/httpPreview"
        // function Start(){
        //     document.images["refresh"].src = image
        //     setTimeout(Start(), 1000);
        // }
        // Start();

        $('#gateNumber').on('change', function(){
            var gateNumber = $('#gateNumber :selected').val();
            console.log(gateNumber);
        })


</script>
@if(session()->has('showModal'))
<script>
    $('#btnAdd').click();
</script>
@endif
@endpush