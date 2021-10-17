@extends('layouts.dashboard')
@section('page-title', 'Dashboard')
@section('home', 'active')

@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-body">
                Welcome, {{Auth::user()->username}}
            </div>
        </div>
    </div>
</div>
@endsection
