<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Siswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="col-md-4 offset-md-4 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Tambah Data Siswa</h3>
                </div>
                <form action="/admin/datasiswa/store" method="post">
                @csrf
                <div class="card-body">
                    @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Terjadi Kesalanan:
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for=""><strong>NIS</strong></label>
                        <input type="text" name="nis" class="form-control" placeholder="NIS">
                    </div>
                    <div class="form-group">
                        <label for=""><strong>Nama Lengkap</strong></label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin"
                        name="jk">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for=""><strong>Kelas</strong></label>
                        <input type="text" name="kelas" class="form-control" placeholder="Kelas">
                    </div>
                    <div class="form-group">
                        <label for=""><strong>Tahun Ajaran</strong></label>
                        <input type="text" name="tahunajaran" class="form-control" placeholder="Tahun Ajaran">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Tambahkan</button>
                    <a href="/admin/datasiswa" class="btn btn-danger btn-block">Kembali</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
