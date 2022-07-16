@extends('layouts.master')
@section('head-title')
    Data Siswa
@stop
@section('title')
    Data Siswa
@stop
@section('content')
<!-- Button trigger modal -->


<div class="col-sm-12">
<button type="button" class="btn bg-gradient-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah Data
</button>

<button type="button" class="btn bg-excel btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
  Excel
</button>
<a href="{{route('exportPDFSiswa')}}" class="btn bg-info btn-sm text-white" target="_blank" rel="noopener noreferrer">PDF</a>
  <div class="card">
    <div class="table-responsive">
      <table class="table align-items-center mb-0" id="data-table">
        <thead>
          <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">#</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA SISWA</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KELAS</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ALAMAT</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO-TELP</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;?>
        @foreach($data_siswa as $row)
          <tr>
          <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold"><?= $i;?></span>
            </td> 
            <td>
              <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-xs">{{$row['nama']}}</h6>
                  <p class="text-xs text-secondary mb-0">{{$row['nisn']}}&nbsp;|&nbsp;{{$row['nis']}}</p>
                </div>
              </div>
            </td>
            <td>
              <p class="text-xs font-weight-bold mb-0">{{$row->kelas->nama_kelas}}</p>
            </td>
           <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold">{{$row['no_telp']}}</span>
            </td> <td class="align-middle text-center text-sm">
              <p class="text-xs font-weight-bold mb-0">{{$row['alamat']}}</p>
            </td>
            
            <td class="align-middle">
              <a href="/dashboard/datasiswa/details/{{$row->nisn}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit">
                Details
              </a>
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
        <h5 class="modal-title" id="tambahModalLabel">Tambah Data Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/dashboard/datasiswa/save-data" method="post">
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">NISN</label>
                <input type="text" class="form-control" id="nisn" name="nisn" placeholder="example: 1020304050">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">NIS</label>
                <input type="text" class="form-control" id="nis" name="nis" placeholder="example: 181910011">
              </div>
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="example: Jhon Chena">
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
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">Kelas</label>
                  <select class="form-control select-custom" multiple="true" name="kelas_id">
                  @foreach($kelas as $rows)
                      <option value="{{$rows->id}}">{{$rows->nama_kelas}}</option>
                    @endforeach()
                  </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleFormControlInput1">ALAMAT</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
              </div>
              <div class="col-md-12">
              <div class="form-group">
                <label for="exampleFormControlInput1">NO-TELEPON</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="example: 081234567890" name="no_telp">
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

<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importModalLabel">Import Excel Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('importExcelSiswa')}}" method="post" enctype="multipart/form-data">
      @csrf
        <div class="modal-body">
          <input type="file" name="importExcelSiswa" id="importExcel" required="required">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
          <a href="{{route('exportExcelSiswa')}}" class="btn bg-warning text-white">Export</a>
          <button type="submit" class="btn bg-excel text-white">Import</button>
        </div>
      </form>
    </div>
  </div>
</div>
@if (session()->has('failures'))
<!-- SHOW ERROR IMPORT -->
<div class="modal fade show" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true" style="display:block;" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document"  style="max-width:800px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Oops!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table align-items-center mb-0 text-xs" id="data-table">
            <thead>
              <tr>
                <th class="text-uppercase text-danger text-xxs text-center">ROW</th>
                <th class="text-uppercase text-danger text-xxs text-center">Attribute</th>
                <th class="text-uppercase text-danger text-xxs text-center">Errors</th>
                <th class="text-uppercase text-danger text-xxs text-center">Values</th>
              </tr>
            </thead>
            <tbody>
            @foreach (session()->get('failures') as $validation)
              <tr>
                <td class="text-center">{{ $validation->row() }}</td>
                <td class="text-center">{{ $validation->attribute() }}</td>
                <td>
                    <ul>
                    @foreach ($validation->errors() as $e)
                      <li class="text-center text-danger">{{ $e }}</li>
                    @endforeach
                    </ul>
                </td>
                <td class="text-center">
                    {{ $validation->values()[$validation->attribute()] }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
      <a href="{{route('datasiswa')}}" class="btn bg-gradient-secondary close-error">Refresh</a>
      </div>
    </div>
  </div>
</div>
@endif
@stop
