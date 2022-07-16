<?php

namespace App\Imports;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

use Illuminate\Validation\ValidationException;

use Throwable;
use App\DataSiswa;
use App\User;
Use Str;


class SiswaImport implements ToModel,SkipsOnError,SkipsOnFailure,WithHeadingRow
,WithValidation
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = new User;
        $siswa = new DataSiswa;

        $user->name = $row["nama"];
        $user->email = "s$row[nis]@siswa.com";
        $user->password = bcrypt("$row[nis]");
        $user->level = "siswa";
        $user->remember_token = Str::random(60);
        
        $siswa->nisn = $row['nisn'];
        $siswa->nis = $row['nis'];
        $siswa->nama = $row['nama'];
        $siswa->spp_id = $row['spp_id'];
        $siswa->kelas_id = $row['kelas_id'];
        $siswa->alamat = $row['alamat'];
        $siswa->no_telp = $row['no_telp'];

        if($row['user_id'] == NULL){
            $user->save();
            
            $siswa->user_id = $user->id;
            $siswa->save();
        }else{
            $user->where('id','=',$user->id)->get();
            $siswa->where('user_id','=',$user->id)->get();

            $user->update();
            $siswa->update();
        }           
        return $siswa;
    }
    
    public function rules(): array
    {
        return [
            '*.nisn' => 'unique:siswa',
            '*.nis' => 'unique:siswa',
            '*.no_telp' => 'unique:siswa'
        ];
    }
}

//     $user = new User;
        //         $user->updateOrCreate(
        //             ['id' => $row['user_id']],
        //             ['name' => $row['nama'],
        //             'email' => "s$row[nis]@gmail.com",
        //             'password' => bcrypt("$row[nis]"),
        //             'level' => "siswa",
        //             'remember_token' => Str::random(60)]);