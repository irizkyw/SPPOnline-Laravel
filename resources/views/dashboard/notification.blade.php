@extends('layouts.master')
@section('title')
  Notification
  @stop
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row pt-3">
            <h6 class="mb-0">Kirim Notifikasi</h6>
        </div>
    </div>
    <div class="card-body">
    <form action="/dashboard/send-notification" method="post">
        @csrf
        <div class="col-md-12 col-sm-6">
            <div class="form-group">
                <label for="exampleFormControlInput1">Nama Notifikasi :</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="" value="" requried>
        </div>
        <div class="col-md-12 col-sm-6">
            <div class="form-group">
                <label for="exampleFormControlInput1">Deskripsi Notifikasi :</label>
            <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="" value="" required></textarea>
        </div>
        <div class="col-md-12 col-sm-6">
            <div class="form-group">
                <label for="exampleFormControlInput1">Kirim Notifikasi Ke :</label>
                <select class="form-control select-custom" multiple="multiple" name="siswa[]" requried>
                @foreach($siswa as $rows)
                    <option value="{{$rows->user->email}}">{{$rows->user->email}} | {{$rows->nama}}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success btn-small">Kirim Yang Telah Dipilih</button>
        <button class="btn btn-secondary btn-small" formaction="{{route('send-all')}}">Kirim Ke Semua Siswa</button>
    </form>
    </div>
</div>
@stop