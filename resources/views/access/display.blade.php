@extends('layouts.app')
@section('title', 'Display')

@section('content')
<div class="row justify-content-center mt-5" >
    <div class="row justify-content-center text-center mb-5">
        <div class="col-6 bg-white p-3 rounded-3 shadow">
            <h1 id="tanggal"></h1>
            <h1 id="jam" class=""></h1>
        </div>
    </div>
    <div class="col mb-3">
        <div class="h-100 p-5 text-white bg-primary rounded-3 text-center shadow" data-bs-toggle="modal" data-bs-target="#modalDCU">
            <h4 class="text-white">Telah melaksanakan DCU</h4>
            <p class="display-5">
            <i class="fas fa-heartbeat"></i>
                {{$total_dcu}}
            </p>
        </div>
    </div>
    <div class="col mb-3">
        <div class="h-100 p-5 text-white bg-warning rounded-3 text-center shadow" data-bs-toggle="modal" data-bs-target="#modalRestrictArea">
            <h4 class="text-white">Area Terbatas</h4>
            <p class="display-5">
                <i class="fas fa-exclamation-triangle"></i>
                {{$total_restrictArea}}
            </p>
        </div>
    </div>
    <div class="col mb-3">
        <div class="h-100 p-5 text-white bg-success rounded-3 text-center shadow" data-bs-toggle="modal" data-bs-target="#modalFit">
            <h4 class="text-white">Pegawai Fit</h4>
            <p class="display-5">
                <i class="fas fa-temperature-high"></i>
                {{$total_fit}}
            </p>
        </div>
    </div>
    <div class="col mb-3">
        <div class="h-100 p-5 text-white bg-danger rounded-3 text-center shadow" data-bs-toggle="modal" data-bs-target="#modalUnfit">
            <h4 class="text-white">Pegawai Unfit</h4>
            <p class="display-5">
                <i class="fas fa-temperature-high"></i>
                {{$total_unfit}}
            </p>
        </div>
    </div>


    <!-- Modal DCU -->
    <div class="modal fade" id="modalDCU" tabindex="-1" aria-labelledby="modalDCULabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable " style="max-width: 70% !important;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title white text-center" id="modalDCULabel">Daily Check Up</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            @if ($dcu->isEmpty())
                <h4 class="text-center">Belum ada pegawai yang melakukan Daily Check Up per Hari ini</h4>
            @else
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">No.</th>
                    <th scope="col">No. Pegawai</th>
                    <th scope="col">Nama Pegawai</th>
                    <th scope="col">Tekanan Darah</th>
                    <th scope="col">Temperature</th>
                    <th scope="col">Fit Status</th>
                    <th scope="col">Tanggal/Jam Daily Check Ups</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dcu as $item)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$item->employees->employee_number}}</td>
                        <td>{{$item->employees->name}}</td>
                        <td>{{$item->blood_pressure}}</td>
                        <td>{{$item->temperature}}°c</td>
                        <td>
                            @if ($item->fit_status == 0)
                                <span class="btn btn-danger btn-sm text-bold">Unfit</span>
                            @else
                                <span class="btn btn-success btn-sm text-bold">Fit</span>
                            @endif
                        </td>
                        <td>{{$item->updated_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            </div>
        </div>
        </div>
    </div>

    <!-- Modal Area Terbatas -->
    <div class="modal fade" id="modalRestrictArea" tabindex="-1" aria-labelledby="modalRestrictAreaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable " style="max-width: 70% !important;">
        <div class="modal-content">
            <div class="modal-header bg-warning">
            <h5 class="modal-title white text-center" id="modalRestrictAreaLabel">Area Terbatas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            @if ($restrictArea->isEmpty())
                <h4 class="text-center">Belum ada pegawai yang masuk ke Area Terbatas</h4>
            @else
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">No.</th>
                    <th scope="col">No. Pegawai</th>
                    <th scope="col">Nama Pegawai</th>
                    <th scope="col">Departemen</th>
                    <th scope="col">Bagian/Fungsi</th>
                    <th scope="col">Nama Perusahaan</th>
                    <th scope="col">Tanggal/Jam Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($restrictArea as $item)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$item->employee_number}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->department}}</td>
                        <td>{{$item->division}}</td>
                        <td>{{$item->company}}</td>
                        <td>{{$item->updated_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Pegawai Fit -->
    <div class="modal fade" id="modalFit" tabindex="-1" aria-labelledby="modalFitLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 70% !important;">
        <div class="modal-content">
            <div class="modal-header bg-success">
            <h5 class="modal-title white text-center" id="modalFitLabel">Pegawai Fit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($fit->isEmpty())
                <h4 class="text-center">Tidak ada pegawai yang unfit/belum ada data Daily Check Up per Hari ini</h4>
            @else
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">No.</th>
                    <th scope="col">No. Pegawai</th>
                    <th scope="col">Nama Pegawai</th>
                    <th scope="col">Tekanan Darah</th>
                    <th scope="col">Temperature</th>
                    <th scope="col">Fit Status</th>
                    <th scope="col">Tanggal/Jam Daily Check Ups</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($fit as $item)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$item->employees->employee_number}}</td>
                            <td>{{$item->employees->name}}</td>
                            <td>{{$item->blood_pressure}}</td>
                            <td>{{$item->temperature}}°c</td>
                            <td>
                            @if ($item->fit_status == 0)
                                <span class="btn btn-danger btn-sm text-bold">Unfit</span>
                            @else
                                <span class="btn btn-success btn-sm text-bold">Fit</span>
                            @endif
                            </td>
                            <td>{{$item->updated_at}}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            @endif
        </div>
        </div>
    </div>
    </div>

    <!-- Modal Pegawai Unfit -->
    <div class="modal fade" id="modalUnfit" tabindex="-1" aria-labelledby="modalUnfitLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 70% !important;">
        <div class="modal-content">
            <div class="modal-header bg-danger">
            <h5 class="modal-title white text-center" id="modalUnfitLabel">Pegawai Unfit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            @if ($unfit->isEmpty())
                <h4 class="text-center">Tidak ada pegawai yang unfit/belum ada data Daily Check Up per Hari ini</h4>
            @else
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">No.</th>
                    <th scope="col">No. Pegawai</th>
                    <th scope="col">Nama Pegawai</th>
                    <th scope="col">Tekanan Darah</th>
                    <th scope="col">Temperature</th>
                    <th scope="col">Fit Status</th>
                    <th scope="col">Tanggal/Jam Daily Check Ups</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($unfit as $item)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$item->employees->employee_number}}</td>
                            <td>{{$item->employees->name}}</td>
                            <td>{{$item->blood_pressure}}</td>
                            <td>{{$item->temperature}}°c</td>
                            <td>
                            @if ($item->fit_status == 0)
                                <span class="btn btn-danger btn-sm text-bold">Unfit</span>
                            @else
                                <span class="btn btn-success btn-sm text-bold">Fit</span>
                            @endif
                            </td>
                            <td>{{$item->updated_at}}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            @endif
        </div>
        </div>
    </div>



</div>


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            setInterval(clockUpdate, 1000);
            var day = new Array(7);
            day[0] = "Minggu";
            day[1] = "Senin";
            day[2] = "Selasa";
            day[3] = "Rabu";
            day[4] = "Kamis";
            day[5] = "Jum'at";
            day[6] = "Sabtu";

            var month = new Array(12);
            month[0] = "Januari";
            month[1] = "Februari";
            month[2] = "Maret";
            month[3] = "April";
            month[4] = "Mei";
            month[5] = "Juni";
            month[6] = "Juli";
            month[7] = "Agustus";
            month[8] = "September";
            month[9] = "Oktober";
            month[10] = "November";
            month[11] = "Desember";

            clockUpdate();

            function clockUpdate(){
                var clock = new Date ();

                function addZero(i) {
                    if (i < 10) {i = "0" + i}
                    return i;
                }

                let hari = day[clock.getDay()];
                let bulan = month[clock.getMonth()];
                let jam = addZero(clock.getHours()) + ":" + addZero(clock.getMinutes()) + ":" + addZero(clock.getSeconds());

                let date = hari + ", " + clock.getDate() + " " + bulan + " " + clock.getFullYear()
                $("#jam").text(jam);
                $("#tanggal").text(date);
            }
            
            setTimeout(function(){
                window.location.reload(1);
            }, 25000);
        })
    </script>
@endpush
