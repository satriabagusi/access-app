@extends('layouts.dashboard')
@section('page-title', 'Data Vendor')
@section('vendor-permit', 'active')
@section('vendor-data', 'text-primary')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Vendor</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    @if ($vendors->isEmpty())
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
                                    <th>Nama Vendor</th>
                                    <th>Detail Vendor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendors as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->vendor_name}}</td>
                                    <td><a href="{{URL::to('/dashboard/vendor/detail/'.\Crypt::encrypt($item->id))}}"
                                            class="btn btn-info btn-sm mb-2">Detail</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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