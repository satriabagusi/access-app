@extends('layouts.dashboard')
@section('page-title', 'Vendor Dashboard')
@section('vendor-project', 'active')
@section('project-list', 'text-primary')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Kontrak</th>
                                <th>Judul Pekerjaan</th>
                                <th>Tanggal Kontrak</th>
                                <th>Tanggal Kontrak Berakhir</th>
                                <th>Durasi Pekerjaan</th>
                                <th>Status</th>
                                <th>Detail</th>
                              </tr>
                          </thead>
                <tbody>

                    @foreach ($projects as $item)
                    <tr>
                        <td>1</td>
                        <td><a href="{{url('/vendor/project/detail/'.\Crypt::encrypt($item->id))}}">{{$item->contract_number}}</a> </td>
                        <td>{{$item->project_name}}</td>
                        <td>{{date('d-m-Y', strtotime($item->contract_start))}}</td>
                        <td>{{date('d-m-Y', strtotime($item->contract_end))}}</td>
                        <td class="text-bold">
                            {{Carbon\Carbon::parse($item->contract_start)->diffInDays(Carbon\Carbon::parse($item->contract_end))}} Hari
                        </td>
                        <td class="text-warning">Upload Permit</td>
                        <td>
                            <a href="{{url('/vendor/project/permit/'.\Crypt::encrypt($item->id))}})}}" class="btn btn-sm btn-warning mb-2">
                                <i data-feather="file-text"></i>
                                Permit
                            </a>
                            <a href="{{url('/vendor/project/detail/'.\Crypt::encrypt($item->id))}}" class="btn btn-success btn-sm ">
                                <i data-feather="edit"></i>
                                Kontrak
                            </a>
                          </td>
                    </tr>
                    @endforeach

                  </tbody>
              </table>
          </div>
            </div>
            <div class="card-footer">
                <div class="float-end">
                    <a href="{{url('/vendor/add-project')}}" class="btn btn-primary">
                        <i data-feather="file-plus"></i>
                        Tambah Data Pekerjaan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
