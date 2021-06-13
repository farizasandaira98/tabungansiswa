<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Transaksi Penarikan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="col-md-4 offset-md-4 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Tambah Transaksi Penarikan</h3>
                </div>
                <form action="/admin/transaksipenarikan/store" method="post">
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
                        <label for=""><strong>Tanggal Penarikan</strong></label>
                        <input type="date" name="tanggalpenarikan" class="form-control" placeholder="Tanggal Penarikan">
                    </div>
                    <div class="form-group">
                          <label><strong>Nama Penarik</strong></label>
                          <select class="form-control" id="id_siswa"
                          name="id_siswa">
                          @foreach($stat as $stat)
                          <option value="{{$stat->id}}">{{$stat->nama}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for=""><strong>Nominal</strong></label>
                        <input type="text" name="nominal" class="form-control" placeholder="Nominal">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Tambahkan</button>
                    <a href="/admin/transaksipenarikan" class="btn btn-danger btn-block">Kembali</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
