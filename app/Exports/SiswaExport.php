<?php

namespace App\Exports;

use App\DataSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = new DataSiswa;
        $return = $data->leftjoin('kelas','siswa.kelas_id','=','kelas.id')->leftjoin('users','siswa.user_id','=','users.id')
        ->select('nisn','nis','nama','kelas_id','nama_kelas','spp_id','kompetensi_keahlian','no_telp','alamat','email','user_id')->get();
        return $return;
    }
    public function headings(): array
    {
        return [
            'Nisn',
            'Nis',
            'Nama',
            'Kelas_id',
            'Kelas',
            'Spp_id',
            'Kompetensi_keahlian',
            'No_telp',
            'Alamat',
            'Akun',
            'user_id',
        ];
    }
}
