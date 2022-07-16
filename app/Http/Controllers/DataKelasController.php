<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KelasExport;
use App\Imports\KelasImport;

Use Str;
use Auth;
class DataKelasController extends Controller
{
    public function index(){
        $data = \App\DataKelas::all();
        return view('dashboard.data_kelas',['data_kelas'=>$data]);
    }

    public function do_save(Request $request){
        $this->validate($request,[
            'nama_kelas' => 'required|unique:kelas',
            'kompetensi_keahlian' => 'required'
        ]);

        $data = \App\DataKelas::create($request->all());
        
        if($data){
            return redirect()->to('/dashboard/datakelas')->with(['alert'=>'Data Berhasil Ditambahkan','icon'=>'success']);
        }
        return redirect()->to('/dashboard/datakelas')->with(['alert'=>'Data Gagal Ditambahkan','icon'=>'error']);
    }

    public function do_update(Request $request , $id){
        $data = \App\DataKelas::find($id);
        $res = $data->update($request->all());

        if($res){
            return redirect()->to('/dashboard/datakelas')->with(['alert'=>'Data Berhasil Dirubah','icon'=>'success']);
        }
        return redirect()->to('/dashboard/datakelas')->with(['alert'=>'Data Gagal Dirubah','icon'=>'error']);
    }
    public function do_delete($id){
        $data = \App\DataKelas::find($id);
        $res = $data->delete();

        if($res){
            return redirect()->to('/dashboard/datakelas')->with(['alert'=>'Data Berhasil Dihapus','icon'=>'success']);
        }
        return redirect()->to('/dashboard/datakelas')->with(['alert'=>'Data Gagal Dihapus','icon'=>'error']);
    }

    public function kelasExport_excel(){
        return Excel::download(new KelasExport,'data_kelas.xlsx');
    }

    public function kelasImport_excel(Request $request){
        $file = $request->file('importExcelkelas')->store('imports/kelas');
        
        $import = new KelasImport;
        $import->import($file);
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
        return back()->with(['alert'=>'Data Berhasil Di Import','icon'=>'success']);
    }
}
