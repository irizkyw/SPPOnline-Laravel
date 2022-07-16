@extends('layouts.master')
@section('head-title')
    Data Petugas
@stop
@section('title')
    Data Petugas
@stop
@section('content')
<!-- Button trigger modal -->


<div class="col-sm-12">
<button type="button" class="btn bg-gradient-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah Data
</button>

  <div class="card">
    <div class="table-responsive">
      <table class="table align-items-center mb-0" id="data-table">
        <thead>
          <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">#</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PETUGAS</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ROLE</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;?>
        @foreach($data_petugas as $row)
          <tr>
          <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold"><?= $i;?></span>
            </td> 
            <td>
              <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-xs">{{$row->email}}</h6>
                  <p class="text-xs text-secondary mb-0">{{$row->name}}</p>
                </div>
              </div>
            </td>
            <td>
              <span class="text-xs font-weight-bold mb-0"> {{$row->level}}</span>
            </td>
            <td class="align-middle">
            <a type="button" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#rubahModal{{$row->id}}">
                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Delete petugas" aria-label="Delete petugas"></i><span class="sr-only">Edit Profile</span>
            </a>&nbsp;&nbsp;
              <a do="/dashboard/petugas/details/{{$row->id}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit">
                  <i class="fas fa-trash text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Delete petugas" aria-label="Delete petugas"></i><span class="sr-only">Edit kelas</span>
              </a>
            </td>
          </tr>
          <?php $i++;?>
          <div class="modal fade" id="rubahModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="rubahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="rubahModalLabel">Rubah Data Petugas</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="/dashboard/petugas/update-data/{{$row->id}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">NAMA PETUGAS</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="example: Ujang" value="{{$row->name}}">
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">EMAIL</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="example: abcd@email.com" value="{{$row->email}}">
                        </div>
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">PASSWORD</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="example: your password" >
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">ROLE</label>
                            <select class="form-control" name="level">
                                <option value="admin" @if($row->level == 'admin') selected @endif >Admin</option>
                                <option value="petugas" @if($row->level == 'petugas') selected @endif >Petugas</option>
                            </select>
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
        <h5 class="modal-title" id="tambahModalLabel">Tambah Data Petugas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/dashboard/petugas/save-data" method="post">
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">NAMA PETUGAS</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="example: Ujang">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">EMAIL</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example: abcd@email.com">
              </div>
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">PASSWORD</label>
              <input type="text" class="form-control" id="password" name="password" placeholder="example: your password">
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleFormControlInput1">ROLE</label>
                <select class="form-control" name="level">
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                </select>
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