<?php

namespace App\Imports;

use App\DataSpp;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class SppImport implements ToModel,WithValidation,SkipsOnError,SkipsOnFailure,WithHeadingRow
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataSpp([
            'id' => $row['id'],
            'tahun' => $row["tahun"],
            'nominal_bulan' => $row['nominal_bulan'],
            'jumlah' => 0
        ]);
    }

    public function rules(): array
    {
        return [
            '*.id' => 'unique:spp'
        ];
    }
}
