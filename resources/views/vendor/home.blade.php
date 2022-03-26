@extends('layouts.dashboard')
@section('page-title', 'Vendor Dashboard')
@section('home', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <h4>Welcome, {{Auth::user()->vendors->vendor_name}}</h4>
            </div>
        </div>
    </div>
</div>
@endsection
