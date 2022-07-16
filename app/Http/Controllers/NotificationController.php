<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataSiswa;
Use App\User;
use App\Notifications\NotificationSiswa;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function index(){
        $user = User::find(1);
        $siswa = DataSiswa::all();
        return view('dashboard/notification',['siswa' => $siswa],compact('user'));
    }

    public function send_notification(Request $request){
        $users = User::all();
       Notification::send($users, new NotificationSiswa($request->nama,$request->deskripsi,Auth()->user()->name,$request->siswa));
        return back()->with(['alert'=>'Data Notifikasi Berhasil Dikirim','icon'=>'success']);
    } 

    public function send_all_notification(Request $request){
        $users = User::all();
        $siswa = User::where('level','siswa')->get('email');
        $rows = [];
        foreach($siswa as $data){
            Notification::send($users, new NotificationSiswa($request->nama,$request->deskripsi,Auth()->user()->name,$data));
        }
        return back()->with(['alert'=>'Data Notifikasi Berhasil Dikirim','icon'=>'success']);
    } 
}