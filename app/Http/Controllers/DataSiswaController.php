<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataSiswa;

use Validator;

use Session;

class DataSiswaController extends Controller
{
  public function index()
    {
        $datasiswa = DataSiswa::paginate(5);
        return view('/admin/datasiswa/datasiswa', ['datasiswa' => $datasiswa]);
    }

    public function tambah()
    {
        return view('/admin/datasiswa/datasiswa_tambah');
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

        $simpan = DataSiswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'kelas' => $request->kelas,
            'tahunajaran' => $request->tahunajaran,
        ]);

        if($simpan){
            Session::flash('success', 'Data Berhasil Ditambahkan');
            return redirect('admin/datasiswa');
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
            return redirect('admin/datasiswa/tambah');
        }
    }

    public function edit($id)
    {
        $datasiswa = DataSiswa::where('id', $id)->first();
        return view('/admin/datasiswa/datasiswa_edit', ['datasiswa' => $datasiswa]);
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

        $datasiswa = DataSiswa::where('id', $id)->first();
        $datasiswa->nis = $request->nis;
        $datasiswa->nama = $request->nama;
        $datasiswa->jk = $request->jk;
        $datasiswa->kelas = $request->kelas;
        $datasiswa->tahunajaran = $request->tahunajaran;
        $simpan = $datasiswa->save();

        if($simpan){
            Session::flash('success', 'Data Berhasil Diedit');
            return redirect('admin/datasiswa');
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
            return redirect('admin/datasiswa');
        }
    }

    public function destroy($id)
    {
        $datasiswa = DataSiswa::where('id', $id)->first();
        $hapus = $datasiswa->delete();
        if($hapus){
            Session::flash('success', 'Data Berhasil Dihapus');
            return redirect('admin/datasiswa');
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
            return redirect('admin/datasiswa');
        }
    }

    public function search(Request $request)
    {
        $cari = $request->search;
        $hasilcari = $datasiswa = DataSiswa::where('nis','LIKE','%'.$cari.'%')
        ->orWhere('nama','LIKE','%'.$cari.'%')
        ->orWhere('jk','LIKE','%'.$cari.'%')
        ->orWhere('kelas','LIKE','%'.$cari.'%')
        ->orWhere('tahunajaran','LIKE','%'.$cari.'%')
        ->paginate(5);

        if($hasilcari){
            Session::flash('success', 'Data Berhasil Ditemukan, Menampilkan Data');
            return view('/admin/datasiswa/datasiswa', ['datasiswa' => $hasilcari]);
        }

    }
}
