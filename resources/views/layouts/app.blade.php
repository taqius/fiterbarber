<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="icon" href="{{asset('images/logo fiter barber.png')}}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @yield('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('images/logo fiter barber.png')}}"
                         class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{asset('images/logo fiter barber.png')}}"
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.2.17
        </div>
        <strong>Copyright &copy; 2020 Fiter Barber</strong> All rights
        reserved.
    </footer>
</div>
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<script src="{{ mix('js/app.js') }}" defer></script>
<script type="text/javascript">
    $(document).ready(function() {

        
        $("#jumlah").keyup(function() {
            var harga  = $("#harga").val();
            var jumlah = $("#jumlah").val();
            var total = parseInt(harga) * parseInt(jumlah);
            $("#total").val(total);
        });
        $("#keterangan").change(function() {
          var keterangan = $("#keterangan").val();
          if(keterangan == 'Potong' ){
            var harga = 10000;
          }else{
            var harga = 40000;
          }
            $("#harga").val(harga);
            var harga  = $("#harga").val();
            var jumlah = $("#jumlah").val();
            var total = parseInt(harga) * parseInt(jumlah);
            $("#total").val(total);
        });

        $("#nama").change(function() {
            var nama = $("#nama").val();
            if(nama == 'Budi'){
                var tempat = 'Cepiring';
            }
            else{
                tempat = 'Ngampel';
            }
            $("#tempat").val(tempat);
        });

        $("#month, #tahun, #pilnama, #ket").change(function() {
            var tgl = $("#month").val();
            var tahun = $("#tahun").val();
            var nama = $("#pilnama").val();
            var ket = $("#ket").val();
            //ajax
            $.get(`/searchbulan/${tgl}/${tahun}/${nama}/${ket}`, function(data){
                var html = '';
                html += `<div class="small-box bg-success">
                        <div class="inner">
                            <h4>${nama}</h4>
                            <p>Total ${ket}, Bulan ${data.bulan} Tahun ${tahun} = ${data.totaljumlah}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-up"></i></a>
                        </div>`;
                $("#laporan").html(html);
            });
        });

        $("#bulan, #tahunk").change(function() {
            var tgl = $("#bulan").val();
            var tahun = $("#tahunk").val();
            
            //ajax
            $.get(`/searchsaldo/${tgl}/${tahun}`, function(data){
                var totaldata = data.total;
                var bon = data.bon;
                var pengeluaran = data.pengeluaran;
                var pemasukan = totaldata - (bon+pengeluaran);
                var totalsaldo = pemasukan - pengeluaran;
                var saldominusbon = totalsaldo - bon;
                var	number_string = totalsaldo.toString(),
                        sisa 	= number_string.length % 3,
                        rupiah 	= number_string.substr(0, sisa),
                        ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                            
                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }
                    var	bons = bon.toString(),
                        sisa 	= bons.length % 3,
                        rupiahb 	= bons.substr(0, sisa),
                        ribuan 	= bons.substr(sisa).match(/\d{3}/g);
                            
                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiahb += separator + ribuan.join('.');
                    }
                    var	peng = pengeluaran.toString(),
                        sisa 	= peng.length % 3,
                        rupiahp 	= peng.substr(0, sisa),
                        ribuan 	= peng.substr(sisa).match(/\d{3}/g);
                            
                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiahp += separator + ribuan.join('.');
                    }
                    var	pem = pemasukan.toString(),
                        sisa 	= pem.length % 3,
                        rupiahpem	= pem.substr(0, sisa),
                        ribuan 	= pem.substr(sisa).match(/\d{3}/g);
                            
                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiahpem += separator + ribuan.join('.');
                    }
                    var	saldokurangibon = saldominusbon.toString(),
                        sisa 	= saldokurangibon.length % 3,
                        rupiahsb	= saldokurangibon.substr(0, sisa),
                        ribuan 	= saldokurangibon.substr(sisa).match(/\d{3}/g);
                            
                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiahsb += separator + ribuan.join('.');
                    }
                var html = '';
                html += `
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4>Pemasukan</h4>
                                <p>Bulan ${data.bulan} Tahun ${tahun}</p>
                                <h4>  Rp. ${rupiahpem}</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-up"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h4>Pengeluaran</h4>
                                <p>Bulan ${data.bulan} Tahun ${tahun}</p>
                                <h4>  Rp. ${rupiahp}</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-up"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-lightblue">
                            <div class="inner">
                                <h4>Total Saldo</h4>
                                <p>Bulan ${data.bulan} Tahun ${tahun}</p>
                                <h4>  Rp. ${rupiah}</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-up"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-6 offset-3">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h4>Total Bon</h4>
                                <p>Bulan ${data.bulan} Tahun ${tahun}</p>
                                <h4>  Rp. ${rupiahb}</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-up"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h5>Saldo Kurangi Bon</h5>
                                <p>Bulan ${data.bulan} Tahun ${tahun}</p>
                                <h4>  Rp. ${rupiahsb}</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-up"></i></a>
                        </div>
                    </div>
                </div>`;
                $("#laporan").html(html);
            });
        });




    });
</script>
@yield('third_party_scripts')

@stack('page_scripts')
</body>
</html>
