@extends('layouts.dashboard')
@section('page-title', 'Dashboard - Detail Permit Project')
@section('permit', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-auto">
        <div class="card shadow">
            <div class="card-body">
            <h2>Detail Pekerjaan</h2>
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
                            <td>{{$project->status}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h2 class="mt-5">Dokumen Permit</h2>
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
                <ul class="list-group">
                @foreach ($permit as $item)
                    <li class="list-group-item">
                        <a target="_blank" href="{{\Storage::url($item->file_name)}}">{{substr($item->file_name, 19)}}</a>
                    </li>
                @endforeach
                </ul>
                <button class="btn btn-outline-success btn-sm mt-2 float-end"><i data-feather="download"></i> Download All to Zip</button>
                <hr>
                <div class="">
                    <h4>Upload Skor</h4>
                </div>

                <div class="row">
                    <div class="col-5 mt-5">
                        <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                    </div>
                </div>
              </div>
              <div id="test-l-2" class="content">
                <p class="text-center">test 2</p>

                <div class="row">
                    <div class="col-5 mt-5">
                        <button class="btn btn-primary" onclick="stepper1.previous()">Back</button>
                        <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                    </div>
                </div>
              </div>
              <div id="test-l-3" class="content">
                <p class="text-center">test 3</p>

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
