<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pegawai</th>
            <th>Suhu</th>
            <th>Tekanan Darah</th>
            <th>No Pegawai</th>
            <th>Nama Departemen</th>
            <th>Divisi</th>
            <th>Nama Perusahaan</th>
            <th>Tanggal/Jam</th>
        </tr>
    </thead>
    <tbody>
            @foreach ($dcu as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->employees->name}}</td>
                    <td>{{$item->temperature}}</td>
                    <td>{{$item->blood_pressure}}</td>
                    <td>{{$item->employees->departments->department}}</td>
                    <td>{{$item->employees->division}}</td>
                    <td>{{$item->employees->company}}</td>
                    <td>{{$item->employees->employee_number}}</td>
                    <td>{{$item->created_at}}</td>
                </tr>
            @endforeach
    </tbody>
</table>
