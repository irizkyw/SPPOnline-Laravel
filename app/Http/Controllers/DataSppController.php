<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SppExport;
use App\Imports\SppImport;
class DataSppController extends Controller
{
    public function index(){
        $data = \App\DataSpp::all();
        
        return view('dashboard.data_spp',['data_spp' => $data]);
    }
    public function do_save(Request $request){
        $request->request->add(['jumlah' => (int)0]);
        $data = \App\DataSpp::create($request->all());

        if($data){
            return redirect()->to('/dashboard/dataspp')->with(['alert'=>'Data Berhasil Ditambahkan','icon'=>'success']);
        }
        return redirect()->to('/dashboard/dataspp')->with(['alert'=>'Data Gagal Ditambahkan','icon'=>'error']);
    }

    public function do_update(Request $request,$id){
        $data = \App\DataSpp::find($id);
        $res = $data->update($request->all());

        if($res){
            return redirect()->to('/dashboard/dataspp')->with(['alert'=>'Data Berhasil Dirubah','icon'=>'success']);
        }
        return redirect()->to('/dashboard/dataspp')->with(['alert'=>'Data Gagal Dirubah','icon'=>'error']);
    }

    public function do_delete($id){
        $data = \App\DataSpp::find($id);
        $res = $data->delete();

        if($res){
            return redirect()->to('/dashboard/dataspp')->with(['alert'=>'Data Berhasil Dihapus','icon'=>'success']);
        }
        return redirect()->to('/dashboard/dataspp')->with(['alert'=>'Data Gagal Dihapus','icon'=>'error']);
    }

    public function sppExport_excel(){
        return Excel::download(new SppExport,'data_spp.xlsx');
    }

    public function sppImport_excel(Request $request){
        $file = $request->file('importExcelSpp')->store('imports/spp');
        
        $import = new SppImport;
        $import->import($file);
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
        return back()->with(['alert'=>'Data Berhasil Di Import','icon'=>'success']);
    }
    public function sppExport_pdf(){
        $data = \App\DataSpp::all();
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 15,
            'margin_bottom' => 20,
            'margin_footer' => 10,
        ]);
        $html = \View::make('PDF.PDF_spp',['data'=>$data]);
        $html = $html->render();
        $mpdf->writeHTML($html);
        $mpdf->Output('PDF_SPP.pdf','I');
        }
}
