@extends('layouts.dashboard')
@section('page-title', 'Vendor Dashboard')
@section('vendor-project', 'active')
@section('project-list', 'text-primary')

@section('content')
<div class="row justify-content-center">
    <div class="col-auto">
        <div class="card shadow">
            <div class="card-body">
                    <h2>Linear stepper</h2>
          <div id="stepper1" class="bs-stepper">
            <div class="bs-stepper-header">
              <div class="step" data-target="#test-l-1">
                <button type="button" class="btn step-trigger">
                  <span class="bs-stepper-circle">1</span>
                  <span class="bs-stepper-label">Form JSA</span>
                </button>
              </div>
              <div class="line"></div>
              <div class="step" data-target="#test-l-2">
                <button type="button" class="btn step-trigger">
                  <span class="bs-stepper-circle">2</span>
                  <span class="bs-stepper-label">Form CSMS</span>
                </button>
              </div>
              <div class="line"></div>
              <div class="step" data-target="#test-l-3">
                <button type="button" class="btn step-trigger">
                  <span class="bs-stepper-circle">3</span>
                  <span class="bs-stepper-label">Form HSE Plan</span>
                </button>
              </div>
              <div class="step" data-target="#test-l-4">
                <button type="button" class="btn step-trigger">
                  <span class="bs-stepper-circle">4</span>
                  <span class="bs-stepper-label">Form Permit</span>
                </button>
              </div>
            </div>
            <div class="bs-stepper-content">
              <div id="test-l-1" class="content">
                <p class="text-start">File JSA</p>
                @foreach ($permit->unique('permit_type_id') as $item)
                {{$item}}
                        <p>
                            <a target="_blank" href="{{\Storage::url($item->file_name)}}">{{substr($item->file_name, 19)}}</a>
                        </p>
                @endforeach
                <hr>
                <p class="text-center">Upload JSA</p>

                <form id="upload" class="" action="{{route('upload_permit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <label for="formFile" class="form-label">Upload File</label>
                        <div class="col-8">
                            <input class="form-control @error('permit_file') is-invalid @enderror" type="file" id="formFile" accept="application/pdf" name="permit_file">
                            <input type="hidden" name="permit_type_id" value="2">
                            <input type="hidden" name="project_id" value="{{$id}}">
                        </div>
                        <div class="col">
                            <button type="submit" form="upload" class="btn btn-sm btn-outline-success">Upload</button>
                        </div>

                        @error('permit_file')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        @error('permit_type_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </form>

                <div class="row">
                    <div class="col-5 mt-5">
                        <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                    </div>
                </div>
              </div>
              <div id="test-l-2" class="content">
                <p class="text-center">test 2</p>
                <form id="upload" class="" action="{{route('upload_permit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <label for="formFile" class="form-label">Upload File</label>
                        <div class="col-8">
                            <input class="form-control" type="file" id="formFile" accept="application/pdf">
                            <input type="hidden" name="permit_type_id" value="2">
                        </div>
                        <div class="col">
                            <button type="submit" form="upload" class="btn btn-sm btn-outline-success">Upload</button>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-5 mt-5">
                        <button class="btn btn-primary" onclick="stepper1.previous()">Back</button>
                        <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                    </div>
                </div>
              </div>
              <div id="test-l-3" class="content">
                <p class="text-center">test 3</p>
                                <form id="upload" class="" action="{{route('upload_permit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <label for="formFile" class="form-label">Upload File</label>
                        <div class="col-8">
                            <input class="form-control" type="file" id="formFile" accept="application/pdf">
                        </div>
                        <div class="col">
                            <button type="submit" form="upload" class="btn btn-sm btn-outline-success">Upload</button>
                            <button class="btn btn-sm btn-outline-info" type="button"><i data-feather="plus"></i></button>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-5 mt-5">
                        <button class="btn btn-primary" onclick="stepper1.previous()">Back</button>
                        <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                    </div>
                </div>
              </div>
              </div>
              <div id="test-l-4" class="content">
                <p class="text-center">test 3</p>
                                <form id="upload" class="" action="{{route('upload_permit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <label for="formFile" class="form-label">Upload File</label>
                        <div class="col-8">
                            <input class="form-control" type="file" id="formFile" accept="application/pdf">
                        </div>
                        <div class="col">
                            <button type="submit" form="upload" class="btn btn-sm btn-outline-success">Upload</button>
                            <button class="btn btn-sm btn-outline-info" type="button"><i data-feather="plus"></i></button>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-5 mt-5">
                        <button class="btn btn-primary" onclick="stepper1.previous()">Back</button>
                    </div>
                </div>
                {{-- <button class="btn btn-primary" onclick="stepper1.next()">Next</button> --}}
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
