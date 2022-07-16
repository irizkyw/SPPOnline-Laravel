<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class DataKelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas','kompetensi_keahlian'];
    public function siswa(){
        return $this->HasMany(DataSiswa::class);
    }
}
