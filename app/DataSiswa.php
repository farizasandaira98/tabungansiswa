<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
  public function transaksi_setoran()
  {
    return $this->hasMany(TransaksiSetoran::class);
  }

  public function transaksi_penarikan()
  {
    return $this->hasMany(TransaksiPenarikan::class);
  }

  protected $table = 'data_siswa';
  protected $fillable = ['nis','nama','jk','kelas','tahunajaran'];
}
