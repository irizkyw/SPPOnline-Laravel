<?php

namespace App\Imports;

use App\DataKelas;
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

class KelasImport implements ToModel,WithValidation,SkipsOnError,SkipsOnFailure,WithHeadingRow
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataKelas([
            'id' => $row['id'],
            'nama_kelas' => $row['nama_kelas'],
            'kompetensi_keahlian' => $row['kompetensi_keahlian'],
        ]);
    }
    public function rules(): array
    {
        return [
            '*.id' => 'unique:kelas',
        ];
    }
}
