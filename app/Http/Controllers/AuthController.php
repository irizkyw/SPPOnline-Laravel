<?php

namespace App\Http\Controllers;
use Session;
Use Str;
Use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function view_login(){
        if(Auth::check()){
            return redirect()->back();
        }
        return view('Auth.login');
    }

    public function view_petugas(){
        $data = \App\User::where('level','!=','siswa')->get();
        return view('dashboard.data_petugas',['data_petugas'=>$data]);
    }

    public function do_login(Request $request){
        $this->validate($request,[
            'email' => 'required|exists:users',
            'password' => 'required|min:4'
        ]);

        if(Auth::attempt($request->only('email','password'))){
            $data = \App\User::find(Auth::id())->siswa;
            if(Auth::user()->level == 'siswa' && $data){
                return redirect()->route('profile',$data->nisn);
            }
            return redirect('/dashboard');
        }
        return redirect()->back()->withInput()->with(['message' => 'Password is incorrect']);
    }

    public function logout(){
        Session::flush();
        return redirect()->to('/');
    }

    public function do_save(Request $request){
        $data = new \App\User;
        $this->validate($request,[
            'nama' =>'min:4|required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'level' => 'required'
        ]);

        $data->name = $request->nama;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->level = $request->level;
        $data->remember_token = Str::random(60);
        $data->save();

        if($data){
            return redirect()->to('/dashboard/petugas')->with('success','Data Berhasil Ditambahkan');
        }
        return redirect()->to('/dashboard/petugas')->with('success','Data Gagal Ditambahkan');
    }

    public function do_update(Request $request,$id){
        $data = \App\User::find($id);
        $this->validate($request,[
            'nama' =>'min:4|required',
            'password' => 'required|min:6',
            'level' => 'required'
        ]);

        $data->name = $request->nama;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->level = $request->level;
        $data->remember_token = Str::random(60);
        $data->update();

        if($data){
            return redirect()->to('/dashboard/petugas')->with('success','Data Berhasil Ditambahkan');
        }
        return redirect()->to('/dashboard/petugas')->with('success','Data Gagal Ditambahkan');
    }
    public function do_delete($id){
        $data = \App\User::find($id);
        $data->delete();

        if($data){
            return redirect()->to('/dashboard/petugas')->with('success','Data Berhasil Dihapus');
        }
        return redirect()->to('/dashboard/petugas')->with('success','Data Gagal Dihapus');
    }
}
