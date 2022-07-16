@extends('layouts.master')
@section('head-title')
    Data Kelas
@stop
@section('title')
    Data Kelas
@stop
@section('content')
<!-- Button trigger modal -->


<div class="col-sm-12">
<button type="button" class="btn bg-gradient-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah Data
</button>

<button a="button" class="btn bg-excel btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
  Excel
</button>

  <div class="card">
    <div class="table-responsive">
      <table class="table align-items-center mb-0" id="data-table">
        <thead>
          <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">#</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">NAMA KELAS</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">KOMPETENSI KEAHLIAN</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
        @foreach($data_kelas as $row)
          <tr>
          <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold"><?= $i;?></span>
            </td> 
           <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold"><a href="{{$row->nama_kelas}}" class="text-secondary">{{$row->nama_kelas}}</a></span>
            </td> 
           <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold"><a href="{{$row->kompetensi_keahlian}}" class="text-secondary">{{$row->kompetensi_keahlian}}</a></span>
            </td> 
            <td class="align-middle">
            <a type="button" class="text-secondary font-weight-bold text-xs edit" data-bs-toggle="modal" data-bs-target="#rubahModal{{$row->id}}">
                  <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Edit Kelas" aria-label="Edit Kelas"></i><span class="sr-only">Edit Profile</span>
            </a>&nbsp;&nbsp;
            <a do="{{url('dashboard/datakelas/delete-data',$row->id)}}" class="text-secondary font-weight-bold text-xs delete">
                  <i class="fas fa-trash text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Delete Kelas" aria-label="Delete Kelas"></i><span class="sr-only">Edit Profile</span>
            </a>
            </td>

          </tr>
          <?php $i++;?>
          <!-- Modal edit-->
          <div class="modal fade" id="rubahModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="rubahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="rubahModalLabel">Rubah Data Kelas</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="/dashboard/datakelas/update-data/{{$row->id}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                      <div class="form-group">
                        <label for="exampleFormControlInput1">NAMA KELAS</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="example: X RPL 1" value="{{$row->nama_kelas}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlInput1">KOMPETENSI KEAHLIAN</label>
                        <input type="text" class="form-control" id="kompetensi_keahlian" name="kompetensi_keahlian" placeholder="example: Rekayasa Perangkat Lunak" value="{{$row->kompetensi_keahlian}}">
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn bg-gradient-primary">Rubah Data</button>
                </div>
              </form>
              </div>
            </div>
          </div>
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
        <h5 class="modal-title" id="tambahModalLabel">Tambah Data Kelas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/dashboard/datakelas/save-data" method="post">
          {{csrf_field()}}
          <div class="row">
            <div class="form-group">
              <label for="exampleFormControlInput1">NAMA KELAS</label>
              <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="example: X RPL 1">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">KOMPETENSI KEAHLIAN</label>
              <input type="text" class="form-control" id="kompetensi_keahlian" name="kompetensi_keahlian" placeholder="example: Rekayasa Perangkat Lunak">
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
        <h5 class="modal-title" id="importModalLabel">Import Excel Kelas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('importExcelKelas')}}" method="post" enctype="multipart/form-data">
      @csrf
        <div class="modal-body">
          <input type="file" name="importExcelkelas" id="importExcel" required="required">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
          <a href="{{route('exportExcelKelas')}}" class="btn bg-warning text-white">Export</a>
          <button type="submit" class="btn bg-excel text-white">Import</button>
        </div>
      </form>
    </div>
  </div>
</div>
@stop