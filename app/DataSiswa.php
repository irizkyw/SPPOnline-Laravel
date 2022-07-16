<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class DataSiswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['nisn','nis','nama','spp_id','kelas_id','alamat','no_telp','user_id'];

    public function kelas(){
        return $this->belongsTo(DataKelas::class);
    }
    public function spp(){
        return $this->belongsTo(DataSpp::class);
    }
    public function pembayaran(){
        return $this->hasMany(Pembayaran::class,'nisn','nisn')->orderBy('created_at','desc');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
