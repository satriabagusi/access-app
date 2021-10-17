@extends('layouts.app')
@section('title', 'DCU - Login')

@section('content')
<div class="row justify-content-center mt-5" >
    <div class="col mb-3">
        <div class="h-100 p-5 text-white bg-primary rounded-3 text-center shadow">
            <h4>Telah melaksanakan DCU</h4>
            <p class="display-5">
            <i class="fas fa-heartbeat"></i>
                {{$total_dcu}}
            </p>
        </div>
    </div>
    <div class="col mb-3">
        <div class="h-100 p-5 text-white bg-warning rounded-3 text-center shadow">
            <h4>Area Terbatas</h4>
            <p class="display-5">
                <i class="fas fa-exclamation-triangle"></i>
                {{$total_restrictArea}}
            </p>
        </div>
    </div>
    <div class="col mb-3">
        <div class="h-100 p-5 text-white bg-success rounded-3 text-center shadow">
            <h4>Pegawai Fit</h4>
            <p class="display-5">
                <i class="fas fa-temperature-high"></i>
                {{$total_fit}}
            </p>
        </div>
    </div>
    <div class="col mb-3">
        <div class="h-100 p-5 text-white bg-danger rounded-3 text-center shadow">
            <h4>Pegawai Unfit</h4>
            <p class="display-5">
                <i class="fas fa-thermometer-quarter"></i>
                {{$total_unfit}}
            </p>
        </div>
    </div>

</div>


@endsection
