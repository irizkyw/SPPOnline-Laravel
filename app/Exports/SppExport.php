<?php

namespace App\Exports;

use App\DataSpp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SppExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataSpp::all();
    }
    public function headings(): array
    {
        return [
            'Id',
            'Tahun',
            'nominal_bulan',
            'Jumlah',
            'Created_at',
            'Updated_at'
        ];
    }
}
