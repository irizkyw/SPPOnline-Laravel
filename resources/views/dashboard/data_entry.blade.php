@extends('layouts.master')
@section('head-title')
    Data Pembayaran
@stop
@section('title')
    Data Pembayaran
@stop
@section('content')
<!-- Button trigger modal -->


<div class="col-sm-12">
<button type="button" class="btn bg-gradient-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Entry Data
</button>

  <div class="card">
    <div class="table-responsive">
      <table class="table align-items-center mb-0" id="data-table">
        <thead>
          <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">#</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">NAMA PETUGAS</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA SISWA</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">TANGGAL BAYAR</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">BULAN DIBAYAR</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SPP TAHUN</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">JUMLAH</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;?>
        @foreach($data_pembayaran as $row)
          <tr>
          <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold"><?= $i;?></span>
            </td> 
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold mb-0">{{Auth()->user()->name}}</span>
            </td>
            <td>
              <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-xs">{{$row->siswa->nama}}</h6>
                  <p class="text-xs text-secondary mb-0">{{$row->nisn}}&nbsp;|&nbsp;{{$row->siswa->nis}}</p>
                </div>
              </div>
            </td>
            <td>
            <span class="text-secondary text-xs font-weight-bold">{{$row->tanggal_bayar}}</span>
            </td>
           <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold">{{$row->bulan_bayar}}</span>
            </td> 
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold mb-0">{{$row->spp->tahun}}</span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold mb-0">Rp.&nbsp;{{ number_format($row->jumlah_bayar,2)}}</span>
            </td>
            
            <td class="align-middle">              
            <a do="{{url('dashboard/datapembayaran/delete-data',$row->id)}}" class="text-secondary font-weight-bold text-xs delete">
                  <i class="fas fa-trash text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Delete Pembayaran" aria-label="Delete Pembayaran"></i><span class="sr-only">Edit Spp</span>
            </a>&nbsp;

              <a href="{{url('dashboard/datasiswa/details',$row->nisn)}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="visit">
                <i class="ni ni-circle-08" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Kunjingi Profil" aria-label="Kunjingi Profil"></i>
              </a> &nbsp;

            </td>
          </tr>
          <?php $i++;?>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahModalLabel">Entry Data Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/dashboard/datapembayaran/save-data" method="post">
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleFormControlInput1">NISN</label>
                <select class="form-control select-custom" multiple="true" name="nisn">
                    @foreach($siswa as $rows)
                      <option value="{{$rows->nisn}}">{{$rows->nisn}} | {{$rows->nama}}</option>
                    @endforeach()
              </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">TANGGAL BAYAR</label>
                <input type="date" class="form-control" id="tanggal_bayar" name="tanggal_bayar">
              </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">BULAN BAYAR</label>
                    <input type="text" class="form-control" id="bulan_bayar" name="bulan_bayar" placeholder="example: Januari - Desember">
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">TAHUN DIBAYAR</label>
                <input type="text" class="form-control" id="tahun_dibayar" name="tahun_dibayar" placeholder="example: 2021">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">SPP TAHUN</label>
                  <select class="form-control select-custom" multiple="true" name="spp_id">
                    @foreach($spp as $rows)
                      <option value="{{$rows->id}}">{{$rows->tahun}}</option>
                    @endforeach()
              </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleFormControlInput1">JUMLAH BAYAR</label>
                <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder="example: 250000">
              </div>
              <div class="col-md-12">
              <div class="form-group">
                <label for="exampleFormControlInput1">KETERANGAN</label>
                <input type="text" class="form-control" id="keterangan" placeholder="example: keterangan" name="keterangan">
              </div>
            </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-gradient-primary">Tambah Data</button>
      </div>
    </form>
    </div>
  </div>
</div>


@stop