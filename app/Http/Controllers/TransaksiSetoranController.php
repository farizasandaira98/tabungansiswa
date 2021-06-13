<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataSiswa;

use App\TransaksiSetoran;

use Validator;

use Session;

use PDF;

class TransaksiSetoranController extends Controller
{
    public function index()
    {
        $transaksisetoran = TransaksiSetoran::paginate(5);
        return view('/admin/transaksisetoran/transaksisetoran')
        ->with(compact('transaksisetoran'));
    }

    public function tambah()
    {
        $stat = DataSiswa::all();
        return view('/admin/transaksisetoran/transaksisetoran_tambah')
        ->with(compact('stat'));
    }

    public function store(Request $request)
    {
        $rules = [
          'id_siswa' => 'required',
          'tanggalsetoran' => 'required',
          'nominal' => 'required'
        ];

        $messages = [
            'id_siswa'                  => 'Id Siswa Dibutuhkan',
            'tanggalsetoran.required'   => 'Tanggal Setoran Wajib Diisi wajib diisi',
            'nominal.required'          => 'Tahun Ajaran Wajib Diisi wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $simpan = TransaksiSetoran::create([
            'id_siswa' => $request->id_siswa,
            'tanggalsetoran' => $request->tanggalsetoran,
            'nominal' => $request->nominal,
        ]);

        if($simpan){
            Session::flash('success', 'Data Berhasil Ditambahkan');
            return redirect('admin/transaksisetoran');
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
            return redirect('admin/transaksisetoran/tambah');
        }
    }

    public function edit($id)
    {
      $stat = DataSiswa::all();
      $transaksisetoran = TransaksiSetoran::where('id', $id)->first();
      return view('/admin/transaksisetoran/transaksisetoran_edit')
      ->with(compact('transaksisetoran'))
      ->with(compact('stat'));
    }


    public function update(Request $request, $id)
    {
      $rules = [
        'id_siswa' => 'required',
        'tanggalsetoran' => 'required',
        'nominal' => 'required'
      ];

      $messages = [
          'id_siswa'                  => 'Id Siswa Dibutuhkan',
          'tanggalsetoran.required'   => 'Tanggal Setoran Wajib Diisi wajib diisi',
          'nominal.required'          => 'Tahun Ajaran Wajib Diisi wajib diisi'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

        $transaksisetoran = TransaksiSetoran::where('id', $id)->first();
        $transaksisetoran->id_siswa = $request->id_siswa;
        $transaksisetoran->tanggalsetoran = $request->tanggalsetoran;
        $transaksisetoran->nominal = $request->nominal;
        $simpan = $transaksisetoran->save();

        if($simpan){
            Session::flash('success', 'Data Berhasil Diedit');
            return redirect('admin/transaksisetoran');
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
            return redirect('admin/transaksisetoran');
        }
    }

    public function destroy($id)
    {
        $transaksisetoran = TransaksiSetoran::where('id', $id)->first();
        $hapus = $transaksisetoran->delete();
        if($hapus){
            Session::flash('success', 'Data Berhasil Dihapus');
            return redirect('admin/transaksisetoran');
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
            return redirect('admin/transaksisetoran');
        }
    }

    public function search(Request $request)
    {
        $cari = $request->search;
        $hasilcari = $transaksisetoran = TransaksiSetoran::select('transaksi_setoran.*')->Where('data_siswa.nama','LIKE','%'.$cari.'%')
        ->orWhere('data_siswa.kelas','LIKE','%'.$cari.'%')
        ->join('data_siswa', 'transaksi_setoran.id_siswa', '=', 'data_siswa.id')
        ->orderBy('data_siswa.nama')
        ->paginate(5);


        if($hasilcari){
            Session::flash('success', 'Data Berhasil Ditemukan, Menampilkan Data');
            return view('/admin/transaksisetoran/transaksisetoran', ['transaksisetoran' => $hasilcari]);
        }
    }
}
