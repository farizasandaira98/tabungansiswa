<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\DataSiswa;

use App\TransaksiSetoran;

use App\TransaksiPenarikan;

use Session;

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

          $nis = $request->nis;
          $penarikan = TransaksiPenarikan::select('transaksi_penarikan.*')->Where('data_siswa.nis','LIKE','%'.$nis.'%')
          ->join('data_siswa', 'transaksi_penarikan.id_siswa', '=', 'data_siswa.id')
          ->sum('transaksi_penarikan.nominal');
          $setoran = TransaksiSetoran::select('transaksi_setoran.*')->Where('data_siswa.nis','LIKE','%'.$nis.'%')
          ->join('data_siswa', 'transaksi_setoran.id_siswa', '=', 'data_siswa.id')
          ->sum('transaksi_setoran.nominal');
          $total = $penarikan-$setoran;
          $laporantransaksi = DataSiswa::where('nis', $nis)->first();

          //return view('/admin/laporantransaksi/laporantransaksi_cetak')

          if($laporantransaksi){
              Session::flash('success', 'Data didapatkan');
              return view('admin/laporantransaksi/laporantransaksi_cetak')
              ->with(compact('penarikan'))
              ->with(compact('setoran'))
              ->with(compact('total'))
              ->with(compact('laporantransaksi'));;
          }else{
            Session::flash('errors', ['' => 'Data tidak ditemukan...']);
            return view('admin/laporantransaksi/laporantransaksi');
          }
      }

      public function cetak_pdf(Request $request)
      {

        $nis = $request->nis;
        $nama = $request->nama;
        $kelas = $request->kelas;
        $setoran = $request->setoran;
        $penarikan = $request->penarikan;
        $total = $request->total;
        if (isset($setoran)) {
          $simpan = TransaksiSetoran::select('transaksi_setoran.*')->Where('data_siswa.nis','LIKE','%'.$nis.'%')
          ->join('data_siswa', 'transaksi_setoran.id_siswa', '=', 'data_siswa.id')
          ->orderBy('data_siswa.nama')->get();
          $data = [
              'simpan'     => $simpan,
              'nis'     => $nis,
              'nama'     => $nama,
              'kelas'     => $kelas,
          ];
          $pdf = PDF::loadview('/admin/laporantransaksi/laporantransaksi_cetak_setoran',$data);
          return $pdf->stream();
        }elseif (isset($penarikan)) {
          $simpan = TransaksiPenarikan::select('transaksi_penarikan.*')->Where('data_siswa.nis','LIKE','%'.$nis.'%')
          ->join('data_siswa', 'transaksi_penarikan.id_siswa', '=', 'data_siswa.id')
          ->orderBy('data_siswa.nama')->get();
          $data = [
              'simpan'     => $simpan,
              'nis'     => $nis,
              'nama'     => $nama,
              'kelas'     => $kelas,
          ];
          $pdf = PDF::loadview('/admin/laporantransaksi/laporantransaksi_cetak_penarikan',$data);
          return $pdf->stream();
        }elseif (isset($total)) {
          $simpan = TransaksiPenarikan::select('transaksi_penarikan.*')->Where('data_siswa.nis','LIKE','%'.$nis.'%')
          ->join('data_siswa', 'transaksi_penarikan.id_siswa', '=', 'data_siswa.id')
          ->sum('transaksi_penarikan.nominal');
          $simpan1 = TransaksiSetoran::select('transaksi_setoran.*')->Where('data_siswa.nis','LIKE','%'.$nis.'%')
          ->join('data_siswa', 'transaksi_setoran.id_siswa', '=', 'data_siswa.id')
          ->sum('transaksi_setoran.nominal');
          $simpan2 = $simpan1-$simpan;
          $data = [
              'simpan'     => $simpan,
              'simpan1'     => $simpan1,
              'simpan2'     => $simpan2,
              'nis'     => $nis,
              'nama'     => $nama,
              'kelas'     => $kelas,
          ];
          $pdf = PDF::loadview('/admin/laporantransaksi/laporantransaksi_cetak_total',$data);
          return $pdf->stream();
        }
    }
}
