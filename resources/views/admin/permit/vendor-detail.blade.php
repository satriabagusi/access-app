@extends('layouts.dashboard')
@section('page-title', 'Detail Vendor '.$vendors->vendor_name)
@section('permit', 'active')
{{-- @section('list-employee', 'text-primary') --}}

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Pekerjaan Vendor {{$vendors->vendor_name}}</h4>
            </div>
          <div class="card-content">
              <div class="card-body">
                  <!-- table hover -->
                  <div class="table-responsive">
                      <table class="table table-hover mb-0">
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
                            <td><a href="{{URL::to('/dashboard/vendor/project/permit/detail/'.\Crypt::encrypt($item->id))}}" class="btn btn-info btn-sm mb-2">Detail</a></td>
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
        </div>
        <div class="card-footer bg-white">

            Jumlah data ditampilkan : {{$projects->count()}}
            <div class="col-auto">{{$projects->links()}}</div>
            </div>
                </div>
            </div>
        </div>
</div>
@endsection

@push('scripts')

@endpush
