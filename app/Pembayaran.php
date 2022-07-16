<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = ['petugas_id','nisn','tanggal_bayar','bulan_bayar','tahun_dibayar','spp_id','jumlah_bayar','keterangan'];
    
    public function siswa(){
        return $this->BelongsTo(DataSiswa::class,'nisn','nisn');
    }

    public function spp(){
        return $this->BelongsTo(DataSpp::class);
    }
}
