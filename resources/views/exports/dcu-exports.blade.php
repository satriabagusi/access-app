<table>
    <thead>
        <tr>
            <th>No</th>
            <th>No Pegawai</th>
            <th>Nama Pegawai</th>
            <th>Nama Departemen</th>
            <th>Divisi</th>
            <th>Nama Perusahaan</th>
            <th>Tanggal/Jam</th>
        </tr>
    </thead>
    <tbody>
        @if ($dcu->isEmpty())
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @else
            @foreach ($dcu as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->employees->employee_number}}</td>
                    <td>{{$item->employees->name}}</td>
                    <td>{{$item->employees->departments->department}}</td>
                    <td>{{$item->employees->division}}</td>
                    <td>{{$item->employees->company}}</td>
                    <td>{{$item->created_at}}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
