<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class DataSpp extends Model
{
    protected $table = 'spp';
    protected $fillable = ['tahun','nominal_bulan','jumlah'];
    public function siswa(){
        return $this->hasMany(DataSiswa::class);
    }

    public function pembayaran(){
        return $this->hasMany(Pembayaran::class,'nisn','nisn');
    }
}
