@extends('layouts.dashboard')
@section('page-title', 'Vendor Dashboard - Upload Permit ')
@section('vendor-project', 'active')
@section('project-list', 'text-primary')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                    <h2 class="mb-4">Upload File Permit {{$project->project_name}}</h2>


                <form id="upload" class="" action="{{route('upload_permit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <fieldset class="form-group col-8">
                            <label for="">Jenis Permit</label>
                            <select name="permit_type_id" class="form-select" id="basicSelect">
                                <option value="1">CSMS</option>
                                <option value="2">JSA</option>
                                <option value="3">HSE PLAN</option>
                                <option value="4">Form Permit</option>
                            </select>
                        </fieldset>
                        <div class="form-group">
                            <label for="formFile" class="form-label">Upload File</label>
                            <div class="col-8">
                                <input class="form-control @error('permit_file') is-invalid @enderror" type="file" id="formFile" accept="application/pdf" name="permit_file">
                                <input type="hidden" name="project_id" value="{{$id}}">
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" form="upload" class="btn btn-sm btn-outline-success float-end">
                                <i data-feather="upload"></i> Upload
                            </button>
                        </div>

                        @error('permit_file')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        @error('permit_type_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </form>
                <hr>
                <div class="col-md-auto">
                    <h5 class="card-title">File Permit</h5>
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
                                    @if (!$csms->isEmpty())
                                    <ul class="list-group">
                                    @foreach ($csms as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span> <a target="_blank" href="{{\Storage::url($item->file_name)}}">{{substr($item->file_name, 19)}}</a></span>
                                            <span class="badge bg-danger badge-pill badge-round ml-1">
                                                <a href="{{URL::to('/vendor/project/permit/delete/'.\Crypt::encrypt($item->id))}}" class="text-decoration-none text-white">X</a>
                                            </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                        <h5 class="mx-auto d-block text-center mb-4">File tidak ditemukan/Belum melakukan upload File</h5>
                                        <img width="300px" src="{{asset('img/data-empty.png')}}" alt="" class="mx-auto d-block img-fluid">
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="v-pills-jsa" role="tabpanel" aria-labelledby="v-pills-jsa-tab">
                                    @if (!$jsa->isEmpty())
                                    <ul class="list-group">
                                    @foreach ($jsa as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span> <a target="_blank" href="{{\Storage::url($item->file_name)}}">{{substr($item->file_name, 19)}}</a></span>
                                            <span class="badge bg-danger badge-pill badge-round ml-1">
                                                <a href="{{URL::to('/vendor/project/permit/delete/'.\Crypt::encrypt($item->id))}}" class="text-decoration-none text-white">X</a>
                                            </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                        <h5 class="mx-auto d-block text-center mb-4">File tidak ditemukan/Belum melakukan upload File</h5>
                                        <img width="300px" src="{{asset('img/data-empty.png')}}" alt="" class="mx-auto d-block img-fluid">
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="v-pills-hsePlan" role="tabpanel" aria-labelledby="v-pills-hsePlan-tab">
                                    @if (!$hse_plan->isEmpty())
                                    <ul class="list-group">
                                    @foreach ($hse_plan as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span> <a target="_blank" href="{{\Storage::url($item->file_name)}}">{{substr($item->file_name, 19)}}</a></span>
                                            <span class="badge bg-danger badge-pill badge-round ml-1">
                                                <a href="{{URL::to('/vendor/project/permit/delete/'.\Crypt::encrypt($item->id))}}" class="text-decoration-none text-white">X</a>
                                            </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                        <h5 class="mx-auto d-block text-center mb-4">File tidak ditemukan/Belum melakukan upload File</h5>
                                        <img width="300px" src="{{asset('img/data-empty.png')}}" alt="" class="mx-auto d-block img-fluid">
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="v-pills-formPermit" role="tabpanel" aria-labelledby="v-pills-formPermit-tab">
                                    @if (!$form_permit->isEmpty())
                                    @foreach ($form_permit as $item)
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span> <a target="_blank" href="{{\Storage::url($item->file_name)}}">{{substr($item->file_name, 19)}}</a></span>
                                            <span class="badge bg-danger badge-pill badge-round ml-1">
                                                <a href="{{URL::to('/vendor/project/permit/delete/'.\Crypt::encrypt($item->id))}}" class="text-decoration-none text-white">X</a>
                                            </span>
                                        </li>
                                        @endforeach
                                    </ul>
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
