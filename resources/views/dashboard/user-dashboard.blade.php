@extends('template-user.index')

@section('content-user')
    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Dashboard</h5>
        </div>
    </div>
    <!-- /Page Header -->	
    <div class="super-admin-dashboard">
        <div class="row">
            <div class="col-xl-7 d-flex">
                <div class="dash-user-card w-100">
                    <h4><i class="fe fe-sun"></i> Selamat Datang, <br>{{ auth()->user()->name }}</h4>
                    <p class="mt-3">Selamat datang di <b>Sistem Kepegawaian Sekolah Bumi Kartini Jepara</b>, platform terintegrasi yang dirancang untuk mengelola dan memantau seluruh data kepegawaian dengan efisien dan akurat. Sistem ini menyediakan berbagai fitur yang membantu dalam pengelolaan administrasi dan sumber daya manusia, sehingga mendukung terciptanya lingkungan kerja yang profesional dan produktif.</p>
                    <div class="dash-btns">
                        <a href="{{ route('user-pegawai') }}" class="btn btn-info">Profile</a>
                        <a href="{{ route('user-status-pegawai') }}" class="btn view-package-btn">Status Pegawai</a>
                    </div>
                    <div class="dash-img">
                        <img src="{{ asset('assets/img/dashboard-card-img.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-xl-5 d-flex p-0">
                <div class="packages card">
                    <div class="package-header d-flex justify-content-between">
                        <div class="d-flex justify-content-between w-100">
                            <div class="">
                                <span class="text-muted">Historis Penggajian</span>
                                <h4>{{ $penggajian->bln_gaji }}, {{ $penggajian->thn_gaji }}</h4>
                            </div>
                            <span class="icon-frame d-flex align-items-center justify-content-center"><img src="{{ asset('assets/img/price-01.svg') }}" alt="img"></span>
                        </div>
                        
                    </div>
                    <h2> Rp. {{ number_format($penggajian->total_gaji_diterima) }}</h2>
                    <h6>Detail Penggajian :</h6>
                    <ul>
                        <li><i class="fa-solid fa-circle-check"></i> {{ $penggajian->harian_transport - $penggajian->satuan_potongan_transport ?? 0 }} Hari Kerja</li>
                        <li><i class="fa-solid fa-circle-check"></i> Gaji Pokok, Tunjangan Struktural ...</li>
                    </ul>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('historis-penggajian') }}" class="btn btn-primary"><i class="fa fa-file me-2"></i> Selengkapnya</a>
                    </div>
                    
                </div>
            </div>
            {{-- <div class="col-xl-12 d-flex">
                <div class="card super-admin-dash-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Kehadiran Pegawai </h5>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <canvas id="attendanceChart"></canvas>
                        <canvas id="chart"></canvas>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var options = {
        chart: {
            type: 'line'
        },
        series: [{
            name: 'sales',
            data: [30,40,35,50,49,60,70,91,125]
        }],
        xaxis: {
            categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
        }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>

@endsection
