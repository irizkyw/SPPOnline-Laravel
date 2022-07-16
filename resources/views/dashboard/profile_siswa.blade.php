@extends('layouts.master')
@section('head-title')
  Profile - {{$data_siswa->nama}}
@stop
@section('title')
  @if(Auth()->user()->level == 'admin')
  <a href="{{url('dashboard/datasiswa')}}" class="text-secondary">
  @endif
Data Siswa</a>&nbsp;&nbsp;/&nbsp;&nbsp;Profile
@stop

@section('content')

<div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url({{asset('assets/img/curved-images/curved0.jpg')}}); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{asset('assets/img/avatar.jpg')}}" alt="..." class="w-100 border-radius-lg shadow-sm">
              <!-- <a href="dashboard/datasiswa/edit/{{$data_siswa->nisn}}" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
              </a> -->
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{$data_siswa->nama}}
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                {{$data_siswa->kelas->nama_kelas}} / {{$data_siswa->kelas->kompetensi_keahlian}}
              </p>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row my-5">
        <div class="col-12 col-xl-6 my-2">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Profile Informasi</h6>
                </div>
                <div class="col-md-4 text-right">
                @if(Auth()->user()->level == 'admin')
                <a type="button" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#rubahModal{{$data_siswa->id}}">
                  <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Edit Profile" aria-label="Edit Profile"></i><span class="sr-only">Edit Profile</span>
                </a> &nbsp;
                <a do="{{url('dashboard/datasiswa/delete-data',$data_siswa->id)}}" class="text-secondary font-weight-bold text-xs delete">
                  <i class="fas fa-trash text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Delete Profile" aria-label="Delete Profile"></i><span class="sr-only">Edit Profile</span>
                </a>
                @endif
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <p class="text-sm">
               Hallo, Saya <strong>{{$data_siswa->nama}}</strong> Dari Kelas <strong>{{$data_siswa->kelas->nama_kelas}}</strong>. <br> Ini adalah Profile dan Data SPP Saya Selama disekolah <strong>SMK ANGKASA 1 MARGAHAYU</strong> <br> <br>
               Untuk bayar SPP Secara Online bisa klik link <a href="">Disini</a>.
              </p>
              <hr class="horizontal gray-light my-4">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">NISN:</strong> &nbsp;{{$data_siswa->nisn}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">NIS:</strong> &nbsp;{{$data_siswa->nis}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Nama Lengkap:</strong> &nbsp;{{$data_siswa->nama}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">HP:</strong> &nbsp; {{$data_siswa->no_telp}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Kelas:</strong> &nbsp; {{$data_siswa->kelas->nama_kelas}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Jurusan:</strong> &nbsp; {{$data_siswa->kelas->kompetensi_keahlian}}</li>
              </ul>
            </div>
          </div>
        </div>
        @if(auth()->user()->level == 'siswa')
        <div class="col-12 col-xl-6 my-2">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                  <h6 class="mb-0">Pemberitahuan</h6>
                </div>
                <div class="col-md-6 text-right">
                </div>
                </div>           
              </p>
            </div>
            <div class="card-body p-3 pb-0">
              <ul class="list-group history-pembayaran">
              @forelse($notifications as $notification)
                @foreach($notification->data['email'] as $data)
                  @if(auth()->user()->email == $data)
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark font-weight-bold text-sm">Dari {{$notification->data['petugas']}}</h6>
                      <span class="text-xs">*{{$notification->data['nama_notifikasi']}}</span>
                    </div>
                    <div class="d-flex align-items-center text-sm">
                      <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$notification->id}}">
                        Baca Selengkapnya
                      </button>
                    </div>
                  </li>
                  @endif
                @endforeach
                <!-- Modal Pemberitahuan-->
                <div class="modal fade" id="staticBackdrop{{$notification->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{$notification->data['nama_notifikasi']}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        {{$notification->data['deskripsi']}}
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                @empty
                  Tidak ada pemberitahuan
              @endforelse
              </ul>
            </div>
          </div>
        </div>
        @endif

        <div class="col-12 @if(auth()->user()->level == 'admin') col-xl-6 @else col-xl-12 @endif) my-2">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                  <h6 class="mb-0">History Pembayaran Saya</h6>
                </div>
                <div class="col-md-6 text-right">
                  <button type="button" class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Lihat Semua
                  </button>
                </div>
              </div>
              <p class="text-sm">Baru Bayar: Rp. 
                <strong data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Baru dibayar" aria-label="Baru dibayar">
                  {{number_format($data_siswa->pembayaran->sum('jumlah_bayar'),2)}}
                </strong> / Rp.
                
                <strong data-bs-toggle="tooltip" data-bs-placement="right" title="" aria-hidden="true" data-bs-original-title="Selama 1 Tahun" aria-label="Selama 1 Tahun">
                  {{number_format($data_siswa->spp->nominal_bulan*12,2)}}
                </strong>
              </p>
            </div>
            <div class="card-body p-3 pb-0">
              <ul class="list-group history-pembayaran">
              @foreach($data_siswa->pembayaran as $row)
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark font-weight-bold text-sm">{{ date('M, d, Y', strtotime($row->tanggal_bayar)) }}</h6>
                    <span class="text-xs">#Bayar Bulan&nbsp; {{$row->bulan_bayar}}, {{$row->spp->tahun}}</span>
                  </div>
                  <div class="d-flex align-items-center text-sm">
                  Rp. {{number_format($row->jumlah_bayar,2)}}
                    <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><a href="{{route('kwitansi',$row->id)}}" target="_blank"><i class="fas fa-file-pdf text-lg me-1" aria-hidden="true"></i> PDF</a></button>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer pt-3">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-left">
                © 2021- <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.instagram.com/irizkyw117" class="font-weight-bold" target="_blank">Ichwan Rizky Wahyudin</a>
                for Maintance web
              </div>
            </div>
          </div>
        </div>
      </footer>

                <!-- Modal edit-->
          <div class="modal fade" id="rubahModal{{$data_siswa->id}}" tabindex="-1" role="dialog" aria-labelledby="rubahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="rubahModalLabel">Rubah Profile</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="/dashboard/datasiswa/update-data/{{$data_siswa->id}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleFormControlInput1">NISN</label>
                          <input type="text" class="form-control" id="nisn" name="nisn" placeholder="example: 1020304050" value="{{$data_siswa->nisn}}">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleFormControlInput1">NIS</label>
                          <input type="text" class="form-control" id="nis" name="nis" placeholder="example: 181910011" value="{{$data_siswa->nis}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlInput1">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="example: Jhon Chena" value="{{$data_siswa->nama}}">
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleFormControlInput1">SPP TAHUN</label>
                            <select class="form-control select-custom" multiple="true" name="spp_id">
                              @foreach($spp as $rows)
                                <option value="{{$rows->id}}" @if($rows->id == $data_siswa->spp_id) selected @endif>{{$rows->tahun}}</option>
                              @endforeach()
                        </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Kelas</label>
                            <select class="form-control select-custom" multiple="true" name="kelas_id">
                            @foreach($kelas as $rows)
                                <option value="{{$rows->id}}" @if($rows->id == $data_siswa->kelas_id) selected @endif >{{$rows->nama_kelas}}</option>
                              @endforeach()
                            </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleFormControlInput1">ALAMAT</label>
                          <input type="text" class="form-control" id="alamat" name="alamat" value="{{$data_siswa->alamat}}">
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleFormControlInput1">NO-TELEPON</label>
                          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="example: 081234567890" name="no_telp" value="{{$data_siswa->no_telp}}">
                        </div>
                      </div>
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

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px;">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tabel Histori Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0" id="data-table">
                    <thead>
                      <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">TANGGAL BAYAR (id)</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">BULAN BAYAR</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">JUMLAH</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">KETERANGAN</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">AKSI</th>
                        @if(request()->is('dashboard/dataspp'))
                        <th></th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;?>
                    @foreach($data_siswa->pembayaran as $row)
                      <tr>
                      <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold"><?= $i;?></span>
                        </td> 
                      <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">{{ date('M, d, Y', strtotime($row->tanggal_bayar)) }}</span>
                          <p class="text-xs text-secondary mb-0">SPP-{{$row->id}} | {{$row->spp->tahun}}</p>
                        </td> 
                      <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">{{ $row->bulan_bayar }}</span>
                        </td> 
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">Rp.&nbsp;{{ number_format($row->jumlah_bayar,2)}}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">{{$row->keterangan}}</span>
                        </td>
                        <td class="align-middle text-center">
                          <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><a href="{{route('kwitansi',$row->id)}}" target="_blank"><i class="fas fa-file-pdf text-lg me-1" aria-hidden="true"></i> PDF</a></button>
                        </td>
                      </tr>
                      <?php $i++;?>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>
@stop