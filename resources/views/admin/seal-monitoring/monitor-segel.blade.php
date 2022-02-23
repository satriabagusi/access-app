@extends('layouts.dashboard')
@section('page-title', 'Monitoring Segel Kendaraan')
@section('monitoring', 'active')

@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">

                    </div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <p>Segel Atas</p>
                        <img src="http://192.168.100.15/ISAPI/Streaming/channels/102/httpPreview" name="refresh" />
                    </div>
                    <div class="col-auto">
                        <p>Segel Samping</p>
                        <img src="http://192.168.100.15/ISAPI/Streaming/channels/102/httpPreview" name="refresh" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="float-end btn btn-primary">Capture</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        var image = "http://192.168.100.15/ISAPI/Streaming/channels/102/httpPreview"
        function Start(){
            document.images["refresh"].src = image
            setTimeout(Start(), 1000);
        }
        Start();
    </script>
@endpush
