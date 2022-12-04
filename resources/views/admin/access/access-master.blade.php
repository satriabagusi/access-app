@extends('layouts.dashboard')
@section('page-title', 'Kartu Akses Master')
@section('control-access', 'active')
@section('access-master', 'text-primary')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Departemen</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    @if ($masterAccess->isEmpty())
                    <div class="text-center">
                        <img class="img-fluid" width="300px" src="{{asset('img/data-empty.png')}}" alt="">
                        <h5 class="mt-4">Belum ada data</h4>
                    </div>
                    @else
                    <!-- table hover -->
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Kartu</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masterAccess as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->uuid_card}}</td>
                                    <td>
                                        <a href="{{URL::to('/dashboard/master-access/card/'.$item->id)}}"
                                            class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row justify-content-between mt-3">
                        <div class="col-auto mt-1">
                            {{-- Jumlah data ditampilkan : {{$departments->count()}} --}}
                        </div>
                        {{-- <div class="col-auto">{{$employees->links()}}</div> --}}
                    </div>
                    @endif
                </div>
                <div class="card-footer text-end">
                    @if(count($masterAccess) < 5) <a href="{{URL::to('/dashboard/master-access-card/add')}}"
                        class="btn btn-primary">Tambah Kartu Master</a>
                        @else
                        <button class="btn btn-primary" disabled>Tambah Kartu Master</button>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush