<?php

namespace App\Exports;

use App\DataKelas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class KelasExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataKelas::all();
    }
    public function headings(): array
    {
        return [
            'ID',
            'Nama_kelas',
            'Kompetensi_keahlian',
            'Created_at',
            'Updated_at'
        ];
    }
}
