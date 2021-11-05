@extends('layouts.dashboard')
@section('page-title', 'Tambah Kartu Master')
@section('control-access', 'active')
@section('access-master', 'text-primary')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Akses Kartu Master</h4>
            </div>
                <div class="card-content">
                    <div class="card-body">

                        <form id="addMasterCard" action="{{route('addMasterCard')}}" method="post">
                            <div class="row">
                                @csrf
                                <div class="form-group has-icon-right">
                                    <label for="uuid_card">Nomor Kartu </label>
                                        <div class="position-relative">
                                            <input type="text" id="uuid_card" class="form-control @error('uuid_card') is-invalid @enderror" placeholder="Nomor Kartu" name="uuid_card" value="{{old('uuid_card')}}" autocomplete="off" autofocus>
                                            <button id="btnRemove" type="button" class="btn btn-sm btn-circle btn-danger form-control-icon" style="margin-right: 10px;">
                                                X
                                            </button>
                                        </div>
                                @error('uuid_card')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div>

                    </div>

                <div class="card-footer bg-white float-end">
                    <a class="btn btn-sm btn-secondary" href="{{URL::to('/dashboard/master-access-card')}}">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </form>

                </div>
                </div>
            </div>
        </div>
</div>

@endsection

@push('scripts')
<script>

$(document).ready(function () {
        $('#addMasterCard').on('keyup keypress', function (e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

        var timer = null;
        $('#uuid_card').on('keyup', function (e) {
            clearTimeout(timer);
            timer = setTimeout(parseDec, 45);
        });

        function parseDec() {
            var uid_parse = parseInt($('#uuid_card').val(), 10).toString(16);
            if (uid_parse.length > 7) {
                uid_parse = uid_parse.substr(2, 8);
                if (uid_parse.charAt(0) == 0) {
                    uid_parse = uid_parse.substring(1);
                }
            } else if (uid_parse.length < 8) {
                uid_parse = uid_parse.slice(1, 7);
            }
            $('#uuid_card').val(uid_parse);
        }

        $('#btnRemove').on('click', function(e){
            $('#uuid_card').val("");
        });
    });

</script>
@endpush
