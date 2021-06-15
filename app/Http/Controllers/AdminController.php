<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\DataSiswa;
Use App\TransaksiSetoran;
Use App\TransaksiPenarikan;
use Session;

class AdminController extends Controller
{
  public function index()
  {
    $penarikan = TransaksiPenarikan::sum('nominal');
    $setoran = TransaksiSetoran::sum('nominal');
    $total = $setoran-$penarikan;
    $user = User::count('name');
    $datasiswa = DataSiswa::count('nama');
    return view('admin/admin')
    ->with(compact('setoran'))
    ->with(compact('penarikan'))
    ->with(compact('total'))
    ->with(compact('user'))
    ->with(compact('datasiswa'));
  }

  public function dataadmin()
  {
  $user = User::all();
  return view('admin/dataadmin/dataadmin')
  ->with(compact('user'));
  }

  public function dataadminhapus($id)
  {
      $user = User::where('id', $id)->first();
      $hapus = $user->delete();
      if($hapus){
          Session::flash('success', 'Data Berhasil Dihapus');
          return redirect('admin/dataadmin');
      } else {
          Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
          return redirect('admin/dataadmin');
      }
  }

  public function dataadmincari(Request $request)
  {
      $cari = $request->search;
      $user = User::where('name','LIKE','%'.$cari.'%')->paginate(5);
      return view('admin/dataadmin/dataadmin', ['user' => $user]);
  }
}
