<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataSiswa;

use App\TransaksiPenarikan;

use Validator;

use Session;

use PDF;

class TransaksiPenarikanController extends Controller
{
  public function index()
  {
      $transaksipenarikan = TransaksiPenarikan::paginate(5);
      return view('/admin/transaksipenarikan/transaksipenarikan')
      ->with(compact('transaksipenarikan'));
  }

  public function tambah()
  {
      $stat = DataSiswa::all();
      return view('/admin/transaksipenarikan/transaksipenarikan_tambah')
      ->with(compact('stat'));
  }

  public function store(Request $request)
  {
      $rules = [
        'id_siswa' => 'required',
        'tanggalpenarikan' => 'required',
        'nominal' => 'required'
      ];

      $messages = [
          'id_siswa'                  => 'Id Siswa Dibutuhkan',
          'tanggalpenarikan.required'   => 'Tanggal Setoran Wajib Diisi wajib diisi',
          'nominal.required'          => 'Tahun Ajaran Wajib Diisi wajib diisi'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $simpan = TransaksiPenarikan::create([
          'id_siswa' => $request->id_siswa,
          'tanggalpenarikan' => $request->tanggalpenarikan,
          'nominal' => $request->nominal,
      ]);

      if($simpan){
          Session::flash('success', 'Data Berhasil Ditambahkan');
          return redirect('admin/transaksipenarikan');
      } else {
          Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
          return redirect('admin/transaksipenarikan/tambah');
      }
  }

  public function edit($id)
  {
    $stat = DataSiswa::all();
    $transaksipenarikan = TransaksiPenarikan::where('id', $id)->first();
    return view('/admin/transaksipenarikan/transaksipenarikan_edit')
    ->with(compact('transaksipenarikan'))
    ->with(compact('stat'));
  }


  public function update(Request $request, $id)
  {
    $rules = [
      'id_siswa' => 'required',
      'tanggalpenarikan' => 'required',
      'nominal' => 'required'
    ];

    $messages = [
        'id_siswa'                  => 'Id Siswa Dibutuhkan',
        'tanggalpenarikan.required'   => 'Tanggal Setoran Wajib Diisi wajib diisi',
        'nominal.required'          => 'Tahun Ajaran Wajib Diisi wajib diisi'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
    }

      $transaksipenarikan = TransaksiPenarikan::where('id', $id)->first();
      $transaksipenarikan->id_siswa = $request->id_siswa;
      $transaksipenarikan->tanggalpenarikan = $request->tanggalpenarikan;
      $transaksipenarikan->nominal = $request->nominal;
      $simpan = $transaksipenarikan->save();

      if($simpan){
          Session::flash('success', 'Data Berhasil Diedit');
          return redirect('admin/transaksipenarikan');
      } else {
          Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
          return redirect('admin/transaksipenarikan');
      }
  }

  public function destroy($id)
  {
      $transaksipenarikan = TransaksiPenarikan::where('id', $id)->first();
      $hapus = $transaksipenarikan->delete();
      if($hapus){
          Session::flash('success', 'Data Berhasil Dihapus');
          return redirect('admin/transaksipenarikan');
      } else {
          Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
          return redirect('admin/transaksipenarikan');
      }
  }

  public function search(Request $request)
  {
      $cari = $request->search;
      $hasilcari = $transaksipenarikan = TransaksiPenarikan::select('transaksi_penarikan.*')->Where('data_siswa.nama','LIKE','%'.$cari.'%')
      ->orWhere('data_siswa.kelas','LIKE','%'.$cari.'%')
      ->join('data_siswa', 'transaksi_penarikan.id_siswa', '=', 'data_siswa.id')
      ->orderBy('data_siswa.nama')
      ->paginate(5);


      if($hasilcari){
          Session::flash('success', 'Data Berhasil Ditemukan, Menampilkan Data');
          return view('/admin/transaksipenarikan/transaksipenarikan', ['transaksipenarikan' => $hasilcari]);
      }
  }
}
