<html>
<head>
	  <title>Admin Sistem Tabungan Siswa | Cetak Data Transaksi Penarikan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 8pt;
		}
	</style>

	<table width="100%">
    <tr>
    <td width="50" align="center"><h5>SEKOLAH MENENGAH KEJURUAN (SMK)</h5><br><h6>Negeri 3 Yogyakarta</h6></td>
    </tr>
    </table>
    <hr>
    <h6 align="center">Data Siswa</h6>
	<table class='table table-bordered'>
		<thead>
                <tr style="text-align: center;">
                  <th>No</th>
                  <th>Tanggal penarikan</th>
                  <th>NIS</th>
                  <th>Nama Siswa</th>
                  <th>Kelas</th>
                  <th>Nominal</th>
                    </tr>
              </thead>
              <tbody>
                @foreach($simpan as $ang)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $ang->tanggalpenarikan }}</td>
                  <td>
                    {{$ang->data_siswa->nis}}
                  </td>
                  <td>
                 {{$ang->data_siswa->nama}}
                 </td>
                 <td>
                   {{$ang->data_siswa->kelas}}
                 </td>
                 <td>{{ $ang->nominal }}</td>
                    </tr>
                    @endforeach
              </tbody>
	</table>
</body>
</html>
