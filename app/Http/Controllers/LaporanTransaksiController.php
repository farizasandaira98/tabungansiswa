<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanTransaksiController extends Controller
{

    public function index()
      {
          
          return view('/admin/laporantransaksi/laporantransaksi')
          ->with(compact('laporantransaksi'));
      }

      public function tambah()
      {
          return view('/admin/laporantransaksi/laporantransaksi_tambah');
      }

      public function store(Request $request)
      {
          $rules = [
            'nis' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'kelas' => 'required',
            'tahunajaran' => 'required'
          ];

          $messages = [
              'nis.required'          => 'NIS Wajib Diisi wajib diisi',
              'nama.required'          => 'Nama Wajib Diisi wajib diisi',
              'jk.required'          => 'Jenis Kelamin Wajib Diisi wajib diisi',
              'kelas.required'          => 'Kelas Wajib Diisi wajib diisi',
              'tahunajaran.required'          => 'Tahun Ajaran Wajib Diisi wajib diisi'
          ];

          $validator = Validator::make($request->all(), $rules, $messages);

          if($validator->fails()){
              return redirect()->back()->withErrors($validator)->withInput($request->all);
          }

          $simpan = laporantransaksi::create([
              'nis' => $request->nis,
              'nama' => $request->nama,
              'jk' => $request->jk,
              'kelas' => $request->kelas,
              'tahunajaran' => $request->tahunajaran,
          ]);

          if($simpan){
              Session::flash('success', 'Data Berhasil Ditambahkan');
              return redirect('admin/laporantransaksi');
          } else {
              Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
              return redirect('admin/laporantransaksi/tambah');
          }
      }

      public function edit($id)
      {
          $laporantransaksi = laporantransaksi::where('id', $id)->first();
          return view('/admin/laporantransaksi/laporantransaksi_edit', ['laporantransaksi' => $laporantransaksi]);
      }


      public function update(Request $request, $id)
      {
        $rules = [
          'nis' => 'required',
          'nama' => 'required',
          'jk' => 'required',
          'kelas' => 'required',
          'tahunajaran' => 'required'
        ];

        $messages = [
            'nis.required'          => 'NIS Wajib Diisi wajib diisi',
            'nama.required'          => 'Nama Wajib Diisi wajib diisi',
            'jk.required'          => 'Jenis Kelamin Wajib Diisi wajib diisi',
            'kelas.required'          => 'Kelas Wajib Diisi wajib diisi',
            'tahunajaran.required'          => 'Tahun Ajaran Wajib Diisi wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

          $laporantransaksi = laporantransaksi::where('id', $id)->first();
          $laporantransaksi->nis = $request->nis;
          $laporantransaksi->nama = $request->nama;
          $laporantransaksi->jk = $request->jk;
          $laporantransaksi->kelas = $request->kelas;
          $laporantransaksi->tahunajaran = $request->tahunajaran;
          $simpan = $laporantransaksi->save();

          if($simpan){
              Session::flash('success', 'Data Berhasil Diedit');
              return redirect('admin/laporantransaksi');
          } else {
              Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
              return redirect('admin/laporantransaksi');
          }
      }

      public function destroy($id)
      {
          $laporantransaksi = laporantransaksi::where('id', $id)->first();
          $hapus = $laporantransaksi->delete();
          if($hapus){
              Session::flash('success', 'Data Berhasil Dihapus');
              return redirect('admin/laporantransaksi');
          } else {
              Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
              return redirect('admin/laporantransaksi');
          }
      }

      public function search(Request $request)
      {
          $cari = $request->search;
          $hasilcari = $laporantransaksi = laporantransaksi::where('nis','LIKE','%'.$cari.'%')
          ->orWhere('nama','LIKE','%'.$cari.'%')
          ->orWhere('jk','LIKE','%'.$cari.'%')
          ->orWhere('kelas','LIKE','%'.$cari.'%')
          ->orWhere('tahunajaran','LIKE','%'.$cari.'%')
          ->paginate(5);

          if($hasilcari){
              Session::flash('success', 'Data Berhasil Ditemukan, Menampilkan Data');
              return view('/admin/laporantransaksi/laporantransaksi', ['laporantransaksi' => $hasilcari]);
          }

      }
}
