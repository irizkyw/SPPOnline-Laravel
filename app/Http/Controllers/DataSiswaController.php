<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Notification\NotificationSiswa;
use Illuminate\Support\Facades\Notification;

Use Str;
use Auth;
use App\User;

class DataSiswaController extends Controller
{
    public function index(){
        $data = \App\DataSiswa::all();
        $spp = \App\DataSpp::all();
        $kelas = \App\DataKelas::all();
        return view('dashboard.data_siswa',['data_siswa' =>$data,'spp' =>$spp,'kelas'=>$kelas]);
    }
    public function profile($id){
        $notifications = auth()->user()->unreadNotifications;
        $data = \App\DataSiswa::where('nisn','=',$id)->first();
        $spp = \App\DataSpp::all();
        $kelas = \App\DataKelas::all();
        return view('dashboard.profile_siswa',compact('notifications'),['data_siswa' =>$data,'spp' =>$spp,'kelas'=>$kelas]);
    }

    public function do_save(Request $request){
        $this->validate($request,[
            'nisn' => 'required|max:15',
            'nis' => 'required|max:9',
            'nama' => 'required|min:4',
            'spp_id' => 'required',
            'kelas_id' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|min:11|max:12'
        ]);
        $user = new \App\User;
        
        $user->name = $request->nama;
        $user->email = "s$request->nis@siswa.com";
        $user->password = bcrypt($request->nis);
        $user->level = "siswa";
        $user->remember_token = Str::random(60);
        $user->save();
        
        $request->request->add(['user_id' => $user->id]);
            if(\App\DataSiswa::create($request->all())){
                return redirect()->to('/dashboard/datasiswa')->with(['alert'=>'Data Berhasil Ditambahkan','icon'=>'success']);
            }
        return redirect()->to('/dashboard/datasiswa')->with(['alert'=>'Data Gagal Ditambahkan','icon'=>'error']);
    }
    public function do_update(Request $request,$id){
        $data = \App\DataSiswa::find($id);
        $res = $data->update($request->all());

        if($res){
            return redirect()->back()->with(['alert'=>'Data Berhasil Dirubah','icon'=>'success']);
        }
        return redirect()->back()->with(['alert'=>'Data Gagal Dirubah','icon'=>'error']);
    }

    public function do_delete($id){
        $data = \App\DataSiswa::find($id);
        if($data->delete()){
            $data->user->delete();
            return redirect()->to('dashboard/datasiswa')->with(['alert'=>'Data Berhasil Dihapus','icon'=>'success']);
        }
        return redirect()->to('dashboard/datasiswa')->with(['alert'=>'Data Gagal Dihapus','icon'=>'error']);
    }

    public function siswaExport_excel(){
        return Excel::download(new SiswaExport,'data_siswa.xlsx');
    }

    public function siswaImport_excel(Request $request){
        $file = $request->file('importExcelSiswa')->store('imports/siswa');
        
        $import = new SiswaImport;
        $import->import($file);
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
        return back()->with(['alert'=>'Data Berhasil Di Import','icon'=>'success']);
    }

    public function siswaExport_pdf(){
        $data = \App\DataSiswa::all();
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 15,
            'margin_bottom' => 20,
            'margin_footer' => 10,
        ]);
        $html = \View::make('PDF.export_pdf',['data'=>$data]);
        $html = $html->render();
        $mpdf->writeHTML($html);
        $mpdf->Output('PDF_DataSiswa.pdf','I');
    }
}
