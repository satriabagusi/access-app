@extends('layouts.dashboard')
@section('page-title', 'Data Vendor')
@section('permit', 'active')
{{-- @section('list-employee', 'text-primary') --}}

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Vendor</h4>
            </div>
          <div class="card-content">
              <div class="card-body">
                  <!-- table hover -->
                  <div class="table-responsive">
                    <table class="table table-hover mb-0">
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
                            <td><a href="{{URL::to('/dashboard/vendor/detail/'.\Crypt::encrypt($item->id))}}" class="btn btn-info btn-sm mb-2">Detail</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="row justify-content-between mt-3">
                <div class="col-auto mt-1">
                    Jumlah data ditampilkan : {{$vendors->count()}}
                </div>
                <div class="col-auto">{{$vendors->links()}}</div>
            </div>
        </div>
        </div>
            </div>
        </div>
</div>
@endsection

@push('scripts')

@endpush
