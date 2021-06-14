<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Sistem Tabungan Siswa | Laporan Transaksi {{$laporantransaksi->nama}}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/admin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/dist/css/cssadmin.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.css')}}">
  <!-- fontawesome v5 -->
  <script src="https://kit.fontawesome.com/72bfe7a45e.js" crossorigin="anonymous"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
   <form class="form-inline ml-3" method="get" action="/admin/transaksisetoran/cari" enctype="multipart/form-data">
       <div class="input-group input-group-sm">
         <input class="form-control form-control-navbar" type="search" placeholder="Cari" aria-label="Search" name="search">
         <div class="input-group-append">
           <button class="btn btn-navbar" type="submit">
             <i class="fas fa-search"></i>
           </button>
         </div>
       </div>
     </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/logout" role="button" onclick="return confirm('Ingin Log Out ?')">
        <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
      <img src="{{asset('assets/admin/dist/img/tutwuri.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Tabungan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/admin/dist/img/profiladmin.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Halo Admin !</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <!-- Dashbord -->
          <li class="nav-item">
            <a href="/admin" class="nav-link ">
            <i class="nav-icon fas fa-columns"></i>
              <p>
                Dashbord
              </p>
            </a>
          </li>
          <!-- / Dashbord -->

          <!-- Data Anggota -->
          <li class="nav-item">
            <a href="/admin/dataadmin" class="nav-link">
            <i class="fas fa-user-friends nav-icon"></i>
              <p>
                Data Admin
              </p>
            </a>
          </li>
          <!-- / Data Anggota -->

          <!-- Data Anggota -->
          <li class="nav-item">
            <a href="/admin/laporantransaksi" class="nav-link">
            <i class="fas fa-user-friends nav-icon"></i>
              <p>
                Data Siswa
              </p>
            </a>
          </li>
          <!-- / Data Anggota -->

          <!-- Artikel Dan Kegiatan-->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fab fa-creative-commons-nd nav-icon"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="/admin/transaksisetoran" class="nav-link">
                <i class="fas fa-briefcase nav-icon"></i>
                  <p>Transaksi Setoran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/transaksipenarikan" class="nav-link">
                <i class="fas fa-newspaper nav-icon"></i>
                  <p>Transaksi Penarikan</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Laporan Transaksi -->
          <li class="nav-item">
            <a href="/admin/laporantransaksi" class="nav-link active">
            <i class="fas fa-money-bill-alt nav-icon"></i>
              <p>
                Laporan Transaksi
              </p>
            </a>
          </li>
          <!-- /Laporan Transaksi -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
       <div class="container-fluid">
         <div class="row mb-2">
           <div class="col-sm-6">
             <h1 class="m-0">Laporan Transaksi</h1>
           </div><!-- /.col -->
           <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="/admin">Home</a></li>
               <li class="breadcrumb-item active">Laporan Transaksi</li>
             </ol>
           </div><!-- /.col -->
         </div><!-- /.row -->
       </div><!-- /.container-fluid -->
     </div>
     <!-- /.content-header -->

     <!-- Main content -->
     <section class="content">
       <div class="container-fluid">
       </br></br>
       <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                 <strong>{{ $message }}</strong>
                </div>
                @endif

                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                 <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
                </div>
                @endif
               <div class="card-body">
                 <div class="card-header">
                     <strong class="text-center">Hasil Laporan Transaksi</strong>
                 </div>
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
                         <label for=""><strong>NIS : {{$laporantransaksi->nis}}</strong></label>
                         <input type="text" name="nis" class="form-control" value="{{$laporantransaksi->nis}}" hidden></br>
                         <label for=""><strong>Nama : {{$laporantransaksi->nama}}</strong></label>
                         <input type="text" name="nama" class="form-control" value="{{$laporantransaksi->nama}}" hidden></br>
                         <label for=""><strong>Jenis Kelamin : {{$laporantransaksi->jk}}</strong></label>
                         <input type="text" name="jk" class="form-control" value="{{$laporantransaksi->jk}}" hidden></br>
                         <label for=""><strong>Kelas : {{$laporantransaksi->kelas}}</strong></label>
                         <input type="text" name="kelas" class="form-control" value="{{$laporantransaksi->kelas}}" hidden></br>
                         <label for=""><strong>Tahun Ajaran : {{$laporantransaksi->tahunajaran}}</strong></label>
                         <input type="text" name="tahunajaran" class="form-control" value="{{$laporantransaksi->tahunajarans}}" hidden>
                     </div>
                 <div class="card-footer">
                     <button type="/admin/laporantransaksi/cetak_setoran" class="btn btn-primary btn-block">Cetak Setoran</button>
                     <button type="/admin/laporantransaksi/cetak_penarikan" class="btn btn-primary btn-block">Cetak Penarikan</button>
                     <button type="/admin/laporantransaksi/cetak_total" class="btn btn-primary btn-block">Cetak Total Saldo</button>
                 </div>
               </div>
               <!-- /.card-body -->
               <div class="card-footer clearfix">

               </div>
             </div>
       </div><!-- /.container-fluid -->
     </section>
     <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->

   <!-- Control Sidebar -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="https://www.instagram.com/farizasandaira/" target="_blank">Anonim</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>AdminLTE</b> V 3.1.0-rc
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('assets/admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('assets/admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('assets/admin/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('assets/admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('assets/admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('assets/admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/admin/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/admin/dist/js/pages/dashboard.js')}}"></script>
</body>
</html>
