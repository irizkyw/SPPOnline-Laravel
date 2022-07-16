<!--
=========================================================
* Soft UI Dashboard - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/soft-ui-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Login SPP DIGITAL
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('assets/css/soft-ui-dashboard.css?v=1.0.1')}}" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.dataTables.css')}}">
</head>

<body class="g-sidenav-show  bg-white">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg  blur blur-rounded top-0  z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.html">
              INFROMASI!
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <div class="nav-item">
                    Untuk Informasi lebih lanjut klik <a href="">Disini</a>.
                </div>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <section>
    <div class="page-header section-height-75">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
            <div class="card card-plain mt-8">
              <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">Selamat Datang</h3>
                <p class="mb-0">Masukan Email dan Password yang sudah tersedia di Sekolah</p>
              </div>
              <div class="card-body">
                <form action="{{url('Auth-login')}}" method="post" role="form text-left">
                @csrf
                  <label>Email</label>
                  <div class="mb-3">
                    <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" value="{{ old('email') }}"placeholder="Email" aria-label="Email" aria-describedby="email-addon" name="email" 
                      @if($errors->has('email')) data-bs-toggle="tooltip" data-bs-placement="right" title="{{$errors->first('email')}}" value="{{old('email')}} data-container="body" data-animation="true" @endif>
                  </div>
                  <label>Password</label>
                  <div class="mb-3">
                    <input type="password" class="form-control @if($errors->has('password') || session('message') ) is-invalid @endif" placeholder="Password" aria-label="Password" aria-describedby="password-addon" name="password" 
                      @if($errors->has('email')) data-bs-toggle="tooltip" data-bs-placement="right" title="{{$errors->first('password')}}" data-container="body" data-animation="true" @endif
                      @if(session('message')) data-bs-toggle="tooltip" data-bs-placement="right" title="{{session('message')}}" data-container="body" data-animation="true" @endif>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                  </div>
                </form>
              </div>
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                  Lupa Email / Password?
                  <a href="javascript:;" class="text-info text-gradient font-weight-bold">Klik Disini</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
              <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-4 fixed-bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-4 mx-auto text-center">
          <a href="https://instagram.com/irizkyw117" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Instagram
          </a>
          <a href="#" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Website
          </a>
        </div>
      </div>
    </div>
  </footer>
  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/js/soft-ui-dashboard.min.js?v=1.0.1')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>