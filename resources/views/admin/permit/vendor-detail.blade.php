@extends('layouts.dashboard')
@section('page-title', 'Detail Vendor PT. XXXX')
@section('permit', 'active')
{{-- @section('list-employee', 'text-primary') --}}

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Pekerjaan Vendor XXX</h4>
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
                      {{-- @foreach ($employees as $item)
                      <tr>
                          <td class="text-bold-500">{{$loop->iteration}}</td>
                          <td>{{$item->uuid_card}}</td>
                          <td>{{$item->name}}</td>
                          <td>{{$item->employee_number}}</td>
                          <td>{{$item->departments->department}}</td>
                          <td>{{$item->division}}</td>
                          <td>
                              <button class="btn btn-info btn-sm mb-2">Edit</button>
                              <a href="{{URL::to('/dashboard/employee/delete/'.$item->id)}}" class="btn btn-danger btn-sm mb-2">Hapus</a>
                          </td>
                        </tr>
                        @endforeach --}}
                        <tr>
                            <td>1</td>
                            <td>Perbaikan CCTV</td>
                            <td>{{date('d-m-Y')}}</td>
                            <td><button class="btn btn-info btn-sm mb-2">Detail</button></td>
                            <td class="text-warning">Upload Permit</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Perbaikan Jaringan</td>
                            <td>{{date('d-m-Y')}}</td>
                            <td><button class="btn btn-info btn-sm mb-2">Detail</button></td>
                            <td class="text-success">Selesai</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Perbaikan Server</td>
                            <td>{{date('d-m-Y')}}</td>
                            <td><button class="btn btn-info btn-sm mb-2">Detail</button></td>
                            <td class="text-success">Selesai</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-between mt-3">
                <div class="col-auto mt-1">
                    {{-- Jumlah data ditampilkan : {{$employees->count()}} --}}
                </div>
                {{-- <div class="col-auto">{{$employees->links()}}</div> --}}
            </div>
        </div>
            <div class="card-footer bg-white">
                <a href="{{URL::to('/dashboard/employee/add')}}" class="float-end btn btn-primary mb-2" >Tambah Data Pegawai</a>
            </div>
                </div>
            </div>
        </div>
</div>
@endsection

@push('scripts')

@endpush
