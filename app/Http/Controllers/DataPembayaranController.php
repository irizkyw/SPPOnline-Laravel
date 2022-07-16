<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class DataPembayaranController extends Controller
{
    public function index(){
        $data = \App\Pembayaran::all();
        $siswa = \App\DataSiswa::all();
        $spp = \App\DataSpp::all();
        return view('dashboard.data_entry',['data_pembayaran' => $data,'spp' => $spp,'siswa'=>$siswa]);
    }

    public function do_save(Request $request){
        $this->validate($request,[
            'nisn' => 'max:15|required',
            'tanggal_bayar' => 'required',
            'bulan_bayar' => 'required',
            'tahun_dibayar' => 'required',
            'jumlah_bayar' => 'numeric|required']);
        $auth = Auth()->user()->id;
        $request->request->add(['petugas_id' => $auth]);
        $data = \App\Pembayaran::create($request->all());

        if($data){
            return redirect()->to('dashboard/datapembayaran')->with(['alert'=>'Data Berhasil Ditambahkan','icon'=>'success']);
        }
        return redirect()->to('dashboard/datapembayaran')->with(['alert'=>'Data Gagal Ditambahkan','icon'=>'error']);
    }

    public function do_delete($id){
        $data = \App\Pembayaran::find($id);
        $get_spp = $data->spp::where('id',$data->spp_id);
        if($data){
            $get_spp->decrement('jumlah',$data->jumlah_bayar);
            $data->delete();
            return redirect()->to('dashboard/datapembayaran')->with(['alert'=>'Data Berhasil Dihapus','icon'=>'success']);
        }
        return redirect()->to('dashboard/datapembayaran')->with(['alert'=>'Data Gagal Dihapus','icon'=>'error']);
    }
    public function kwitansiExport_pdf($id){
        $data = \App\Pembayaran::find($id);
        $petugas = \App\User::where('id',$data->petugas_id)->get('name');
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 15,
            'margin_bottom' => 20,
            'margin_footer' => 10,
        ]);
        $html = \View::make('PDF.PDF_kwitansi',['data'=>$data,'petugas'=>$petugas]);
        $html = $html->render();
        $mpdf->writeHTML($html);
        $mpdf->Output('Bukti_pembayaran.pdf','I');
    }
}
