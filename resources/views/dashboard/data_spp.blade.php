@extends('layouts.master')
@section('head-title')
    Data Spp
@stop
@section('title')
    Data Spp
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

<a href="{{route('exportPDFSpp')}}" class="btn bg-info btn-sm text-white" target="_blank" rel="noopener noreferrer">PDF</a>

  <div class="card">
    <div class="table-responsive">
      <table class="table align-items-center mb-0" id="data-table">
        <thead>
          <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">#</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">TAHUN (id)</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">NOMINAL/BULAN</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">JUMLAH</th>
            @if(request()->is('dashboard/dataspp'))
            <th></th>
            @endif
          </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
        @foreach($data_spp as $row)
          <tr>
          <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold"><?= $i;?></span>
            </td> 
           <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold">{{$row->tahun}}</span>
              <p class="text-xs text-secondary mb-0">SPP-{{$row->id}}</p>
            </td> 
           <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold">Rp.&nbsp;{{ number_format($row->nominal_bulan,2)}}</span>
            </td> 
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold">Rp.&nbsp;{{ number_format($row->jumlah,2)}}</span>
            </td> 
            @if(request()->is('dashboard/dataspp'))
            <td class="align-middle">
            <a type="button" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#rubahModal{{$row->id}}">
                  <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Delete Spp" aria-label="Delete Spp"></i><span class="sr-only">Edit Spp</span>
            </a>&nbsp;&nbsp;
            <a do="{{url('dashboard/dataspp/delete-data',$row->id)}}" class="text-secondary font-weight-bold text-xs delete">
                  <i class="fas fa-trash text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Delete Spp" aria-label="Delete Spp"></i><span class="sr-only">Edit Spp</span>
            </a>
            </td>
            @endif
          </tr>
          <?php $i++;?>
          <!-- Modal edit-->
          <div class="modal fade" id="rubahModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="rubahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="rubahModalLabel">Rubah Data SPP</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="/dashboard/dataspp/update-data/{{$row->id}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                      <div class="form-group">
                        <label for="exampleFormControlInput1">TAHUN</label>
                        <input type="text" class="form-control" id="tahun" name="tahun" placeholder="example: 2020-1" value="{{$row->tahun}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlInput1">NOMINAL/BULAN</label>
                        <input type="text" class="form-control" id="nominal_bulan" name="nominal_bulan" placeholder="example: 250000" value="{{$row->nominal_bulan}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlInput1">JUMLAH</label>
                        <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="example: Pendapatan SPP" value="{{$row->jumlah}}">
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
        <h5 class="modal-title" id="tambahModalLabel">Tambah Data SPP</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/dashboard/dataspp/save-data" method="post">
          {{csrf_field()}}
          <div class="row">
            <div class="form-group">
              <label for="exampleFormControlInput1">TAHUN</label>
              <input type="text" class="form-control" id="tahun" name="tahun" placeholder="example: 2020-1">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">NOMINAL/BULAN</label>
              <input type="text" class="form-control" id="nominal_bulan" name="nominal_bulan" placeholder="example: 250000">
              <input type="hidden" class="form-control" id="jumlah" name="jumlah">
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
        <h5 class="modal-title" id="importModalLabel">Import Excel SPP</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('importExcelSpp')}}" method="post" enctype="multipart/form-data">
      @csrf
        <div class="modal-body">
          <input type="file" name="importExcelSpp" id="importExcel" required="required">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
          <a href="{{route('exportExcelSpp')}}" class="btn bg-warning text-white">Export</a>
          @if(request()->is('dashboard/dataspp'))
            <button type="submit" class="btn bg-excel text-white">Import</button>
            @endif
        </div>
      </form>
    </div>
  </div>
</div>
@stop