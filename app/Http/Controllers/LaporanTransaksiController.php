<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\DataSiswa;

use App\TransaksiSetoran;

use App\TransaksiPenarikan;

use PDF;

class LaporanTransaksiController extends Controller
{

    public function index()
      {

          return view('/admin/laporantransaksi/laporantransaksi')
          ->with(compact('laporantransaksi'));
      }

      public function store(Request $request)
      {
          $rules = [
            'nis' => 'required',
          ];

          $messages = [
              'nis.required'          => 'NIS Wajib Diisi wajib diisi',
          ];

          $validator = Validator::make($request->all(), $rules, $messages);

          if($validator->fails()){
              return redirect()->back()->withErrors($validator)->withInput($request->all);
          }

          $simpan = $cari = $request->nis;
          $laporantransaksi = DataSiswa::where('nis', $simpan)->first();

          return view('/admin/laporantransaksi/laporantransaksi_cetak')
          ->with(compact('simpan'))
          ->with(compact('laporantransaksi'));

          if($simpan){
              Session::flash('success', 'Data Berhasil Ditambahkan');
              return redirect('admin/laporantransaksi');
          } else {
              Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
              return redirect('admin/laporantransaksi/tambah');
          }
      }

      public function cetak_pdf(Request $request)
      {

        $nis = $request->nis;
        $setoran = $request->setoran;
        $penarikan = $request->penarikan;
        $total = $request->total;
        if (isset($setoran)) {
          $simpan = TransaksiSetoran::select('transaksi_setoran.*')->Where('data_siswa.nis','LIKE','%'.$nis.'%')
          ->join('data_siswa', 'transaksi_setoran.id_siswa', '=', 'data_siswa.id')
          ->orderBy('data_siswa.nama');

          $data = [
              'simpan'     => $simpan
          ];
          
          $pdf = PDF::loadview('/admin/laporantransaksi/laporantransaksi_cetak_setoran',$data);
          return $pdf->stream();
        }elseif (isset($penarikan)) {
          $simpan = TransaksiPenarikan::find($nis);
          $pdf = PDF::loadview('/admin/laporantransaksi/laporantransaksi_cetak_penarikan', ['simpan' => $simpan]);
          return $pdf->stream();
        }
    }
}
