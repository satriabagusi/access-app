@extends('layouts.dashboard')
@section('page-title', 'History Akses Area Terbatas')
@section('history', 'active')
@section('access-history', 'text-primary')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-end">
                    <div class="col">
                        <h4 class="card-title">Data Akses Area Terbatas</h4>
                    </div>
                    <div class="col-auto">

                        <form method="GET" action="{{URL::to('/dashboarad/history/access/download')}}"
                            class="form-group">
                            <div class="form-group has-icon-right">
                                <div id="daterangepicker" class="position-relative">
                                    <input type="text" class="form-control" placeholder="Date" id="date" name="date"
                                        required>
                                    <input type="hidden" class="form-control" placeholder="Date" id="dateStart"
                                        name="dateStart">
                                    <input type="hidden" class="form-control" placeholder="Date" id="dateEnd"
                                        name="dateEnd">
                                    <div id="daterangepicker" class="form-control-icon">
                                        <i data-feather="calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Export Selected</button>
                            &nbsp;
                            <a href="{{URL::to('/dashboarad/history/access/download')}}"
                                class="float-end ml-50 btn btn-primary">Export all to Excel</a>
                            &nbsp;
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <!-- table hover -->
                    @if ($access_history->isEmpty())
                    <div class="text-center">
                        <img class="img-fluid" width="300px" src="{{asset('img/data-empty.png')}}" alt="">
                        <h5 class="mt-4">Belum ada data</h4>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pegawai</th>
                                    <th>Status</th>
                                    <th>Nama Departemen</th>
                                    <th>Divisi</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($access_history as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->employees->name}}</td>
                                    @if ($item->access_status == 1)
                                    <td class="text-primary">Tap In</td>
                                    @elseif($item->access_status == 2)
                                    <td class="text-danger">Tap Out</td>
                                    @endif
                                    <td>{{$item->employees->departments->department}}</td>
                                    <td>{{$item->employees->division}}</td>
                                    <td>{{$item->employees->company}}</td>
                                    <td>{{$item->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="row justify-content-between mt-3">
                        <div class="col-auto mt-1">
                            Jumlah data ditampilkan : {{$access_history->count()}}
                        </div>
                        <div class="col-auto">{{$access_history->links()}}</div>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    <span>&nbsp;</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
            $('#daterangepicker').daterangepicker({
                ranges   : {
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment(),
                locale: 'id',
                },
                function (start, end) {
                    $('#date').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                    $('#dateStart').val(start.format('YYYY-MM-DD'));
                    $('#dateEnd').val(end.format('YYYY-MM-DD'));
                },
            )
        });
</script>
@endpush