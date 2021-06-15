<html>
<head>
	  <title>Admin Sistem Tabungan Siswa | Cetak Data Transaksi Total</title>
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
    <h4 align="center">Data Transaksi Setoran</h4>
		<h6 align="center">NIS : {{$nis}}</h6>
		<h6 align="center">Nama : {{$nama}}</h6>
		<h6 align="center">Kelas : {{$kelas}}</h6>
	<table class='table table-bordered'>
		<thead>
              </thead>
              <tbody>
							 <tr>
							  <td colspan="2">Jumlah Total Setoran :</td>
								<td colspan="1">{{ $simpan1 }}</td>
							</tr>
								<tr>
								<td colspan="2">Jumlah Total Penarikan :</td>
							 <td colspan="1">{{ $simpan }}</td>
						 </tr>
						 <tr>
							 <td colspan="2">Jumlah Total Saldo :</td>
							 <td colspan="1">{{ $simpan2 }}</td>
						   </tr>
              </tbody>
	</table>
</body>
</html>
