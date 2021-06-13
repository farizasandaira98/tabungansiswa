<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPenarikan extends Model
{
  protected $table = 'transaksi_penarikan';
      protected $fillable = ['id_siswa','tanggalpenarikan','nominal'];
      
      public function data_siswa()
      {
        return $this->belongsTo(DataSiswa::class,'id_siswa');
      }
}
