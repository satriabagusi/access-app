@extends('layouts.dashboard')
@section('page-title', 'Data Departemen')
@section('control-access', 'active')
@section('list-department', 'text-primary')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Departemen</h4>
            </div>
          <div class="card-content">
              <div class="card-body">
                  <!-- table hover -->
                  <div class="table-responsive">
                      <table class="table table-hover mb-0">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Nama Departemen</th>
                                  <th>ACTION</th>
                                </tr>
                            </thead>
                  <tbody>
                      @foreach ($departments as $item)
                      <tr>
                          <td class="text-bold-500">{{$loop->iteration}}</td>
                          <td>{{$item->department}}</td>
                          <td>
                              <a href="{{URL::to('/dashboard/department/edit/'.$item->id)}}" class="btn btn-info btn-sm mb-2">Edit</a>
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
        </div>
            <div class="card-footer bg-white">
                <a href="{{URL::to('/dashboard/department/add')}}" class="float-end btn btn-primary mb-2" >Tambah Departemen</a>
            </div>
                </div>
            </div>
        </div>
</div>
@endsection

@push('scripts')

@endpush
