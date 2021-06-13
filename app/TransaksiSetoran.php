<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiSetoran extends Model
{
  protected $table = 'transaksi_setoran';
      protected $fillable = ['id_siswa','tanggalsetoran','nominal'];
      public function data_siswa()
      {
        return $this->belongsTo(DataSiswa::class,'id_siswa');
      }
}
