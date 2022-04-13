@extends('layouts.dashboard')
@section('page-title', 'Dashboard - Detail Permit Project')
@section('permit', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
            <h2>Detail Pekerjaan {{$project->vendors->vendor_name}}</h2>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <td>Nama Pekerjaan</td>
                            <td>Tanggal Kontrak</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$project->project_name}}</td>
                            <td>{{$project->contract_start}}</td>
                            @if ($project->status == 0)
                                <td class="text-warning">Upload Permit</td>
                            @elseif($project->status == 1)
                                <td class="text-primary">Review by Admin</td>
                            @elseif($project->status == 2)
                                <td class="text-success">Skor sudah upload</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2 class="mt-5 mb-4">Dokumen Permit</h2>

            <div class="row">
                <div class="col-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-csms-tab" data-bs-toggle="pill" href="#v-pills-csms" role="tab"
                            aria-controls="v-pills-csms" aria-selected="true">CSMS</a>
                        <a class="nav-link" id="v-pills-jsa-tab" data-bs-toggle="pill" href="#v-pills-jsa" role="tab"
                            aria-controls="v-pills-jsa" aria-selected="false">JSA</a>
                        <a class="nav-link" id="v-pills-hsePlan-tab" data-bs-toggle="pill" href="#v-pills-hsePlan" role="tab"
                            aria-controls="v-pills-hsePlan" aria-selected="false">HSE PLAN</a>
                        <a class="nav-link" id="v-pills-formPermit-tab" data-bs-toggle="pill" href="#v-pills-formPermit" role="tab"
                            aria-controls="v-pills-formPermit" aria-selected="false">Form Permit</a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-csms" role="tabpanel" aria-labelledby="v-pills-csms-tab">
                            <div class="row">
                            @if (!$csms->isEmpty())
                                <div class="col-8">
                                    <ul class="list-group">
                                        @foreach ($csms as $item)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span> <a target="_blank" href="{{\Storage::url($item->file_name)}}">{{substr($item->file_name, strrpos($item->file_name, '/') + 1)}}</a></span>
                                            </li>
                                        @endforeach
                                    </ul>
                                        <a href="{{\URL::to('/dashboard/vendor/project/permit/download/'.\Crypt::encrypt(1).'&'.\Crypt::encrypt($project->id))}}" class="btn btn-outline-success float-end mt-2">
                                            <i data-feather="download"></i>
                                            Download All to Zip
                                        </a>
                                </div>
                                <div class="col-4">
                                    <h5>Skor</h5>
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="" id="">
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i data-feather="check-circle"></i>
                                            Submit
                                        </button>
                                    </form>
                                </div>
                                @else
                                <h5 class="mx-auto d-block text-center mb-4">File tidak ditemukan/Belum melakukan upload File</h5>
                                <img width="300px" src="{{asset('img/data-empty.png')}}" alt="" class="mx-auto d-block img-fluid">
                                @endif
                            </div>
                        </div>


                        <div class="tab-pane fade" id="v-pills-jsa" role="tabpanel" aria-labelledby="v-pills-jsa-tab">
                            <div class="row">
                                @if (!$jsa->isEmpty())
                                    <div class="col-8">
                                        <ul class="list-group">
                                            @foreach ($jsa as $item)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span> <a target="_blank" href="{{\Storage::url($item->file_name)}}">{{substr($item->file_name, strrpos($item->file_name, '/') + 1)}}</a></span>
                                                </li>
                                            @endforeach
                                        </ul>
                                            <a href="{{\URL::to('/dashboard/vendor/project/permit/download/'.\Crypt::encrypt(2).'&'.\Crypt::encrypt($project->id))}}" class="btn btn-outline-success float-end mt-2">
                                                <i data-feather="download"></i>
                                                Download All to Zip
                                            </a>
                                    </div>
                                    <div class="col-4">
                                        <h5>Skor</h5>
                                        <form action="#" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="" id="">
                                            </div>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i data-feather="check-circle"></i>
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                    @else
                                    <h5 class="mx-auto d-block text-center mb-4">File tidak ditemukan/Belum melakukan upload File</h5>
                                    <img width="300px" src="{{asset('img/data-empty.png')}}" alt="" class="mx-auto d-block img-fluid">
                                    @endif
                                </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-hsePlan" role="tabpanel" aria-labelledby="v-pills-hsePlan-tab">
                            <div class="row">
                                @if (!$hse_plan->isEmpty())
                                    <div class="col-8">
                                        <ul class="list-group">
                                            @foreach ($hse_plan as $item)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span> <a target="_blank" href="{{\Storage::url($item->file_name)}}">{{substr($item->file_name, strrpos($item->file_name, '/') + 1)}}</a></span>
                                                </li>
                                            @endforeach
                                        </ul>
                                            <a href="{{\URL::to('/dashboard/vendor/project/permit/download/'.\Crypt::encrypt(3).'&'.\Crypt::encrypt($project->id))}}" class="btn btn-outline-success float-end mt-2">
                                                <i data-feather="download"></i>
                                                Download All to Zip
                                            </a>
                                    </div>
                                    <div class="col-4">
                                        <h5>Skor</h5>
                                        <form action="#" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="" id="">
                                            </div>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i data-feather="check-circle"></i>
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                    @else
                                    <h5 class="mx-auto d-block text-center mb-4">File tidak ditemukan/Belum melakukan upload File</h5>
                                    <img width="300px" src="{{asset('img/data-empty.png')}}" alt="" class="mx-auto d-block img-fluid">
                                    @endif
                                </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-formPermit" role="tabpanel" aria-labelledby="v-pills-formPermit-tab">
                            <div class="row">
                                @if (!$form_permit->isEmpty())
                                    <div class="col-8">
                                        <ul class="list-group">
                                            @foreach ($form_permit as $item)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span> <a target="_blank" href="{{\Storage::url($item->file_name)}}">{{substr($item->file_name, strrpos($item->file_name, '/') + 1)}}</a></span>
                                                </li>
                                            @endforeach
                                        </ul>
                                            <a href="{{\URL::to('/dashboard/vendor/project/permit/download/'.\Crypt::encrypt(4).'&'.\Crypt::encrypt($project->id))}}" class="btn btn-outline-success float-end mt-2">
                                                <i data-feather="download"></i>
                                                Download All to Zip
                                            </a>
                                    </div>
                                    <div class="col-4">
                                        <h5>Skor</h5>
                                        <form action="#" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="" id="">
                                            </div>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i data-feather="check-circle"></i>
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                    @else
                                    <h5 class="mx-auto d-block text-center mb-4">File tidak ditemukan/Belum melakukan upload File</h5>
                                    <img width="300px" src="{{asset('img/data-empty.png')}}" alt="" class="mx-auto d-block img-fluid">
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        var stepper1Node = document.querySelector('#stepper1')
        var stepper1 = new Stepper(document.querySelector('#stepper1'))

        stepper1Node.addEventListener('show.bs-stepper', function (event) {
            console.warn('show.bs-stepper', event)
        })

        $(document).ready(function (){
            var stepper = new Stepper($('.bs-stepper')[0]);

        })


    Dropzone.options.myGreatDropzone = { // camelized version of the `id`
      //paramName: "file", // The name that will be used to transfer the file
      maxFilesize: 2, // MB
      addRemoveLinks: true,
      acceptedFiles: 'application/pdf',
    };
    </script>
@endpush
