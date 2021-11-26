<table>
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
