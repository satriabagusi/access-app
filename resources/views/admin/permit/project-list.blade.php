@extends('layouts.dashboard')
@section('page-title', 'Data Proyek Vendor')
@section('vendor-permit', 'active')
@section('proyek-data', 'text-primary')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Proyek Vendor</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    @if ($projects->isEmpty())
                    <div class="text-center">
                        <img class="img-fluid" width="300px" src="{{asset('img/data-empty.png')}}" alt="">
                        <h5 class="mt-4">Belum ada data</h4>
                    </div>
                    @else
                    <!-- table hover -->
                    <div class="table-responsive">
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pekerjaan</th>
                                    <th>Tanggal Kontrak</th>
                                    <th>Permit</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->project_name}}</td>
                                    <td>{{$item->contract_start}}</td>
                                    <td><a href="{{URL::to('/dashboard/vendor/project/permit/detail/'.\Crypt::encrypt($item->id))}}"
                                            class="btn btn-info btn-sm mb-2">Detail</a></td>
                                    <td class="text-warning">Upload Permit</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row justify-content-between mt-3">
                        <div class="col-auto mt-1">
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    <span>&nbsp;</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
</script>
@endpush