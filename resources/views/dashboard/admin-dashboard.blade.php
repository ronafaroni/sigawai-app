@extends('template-admin.index')

@section('content-admin')
    <!-- Page Wrapper -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-1">
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Data Pegawai</div>
                            <div class="dash-counts">
                                <p>
                                <p>{{ number_format($pegawai, 0, ',', '.') }} Orang</p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-2">
                            <i class="fas fa-users"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Unit Kerja</div>
                            <div class="dash-counts">
                                <p>{{ $unit_kerja }} Unit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-3">
                            <i class="fas fa-file-alt"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Pegawai Tetap Yayasan</div>
                            <div class="dash-counts">
                                <p>{{ number_format($tetap_yayasan, 0, ',', '.') }} Orang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-4">
                            <i class="far fa-file"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Pegawai Tetap</div>
                            <div class="dash-counts">
                                <p>{{ number_format($tetap, 0, ',', '.') }} Orang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-4">
                            <i class="far fa-file"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Pegawai Tidak Tetap</div>
                            <div class="dash-counts">
                                <p>{{ number_format($tidak_tetap, 0, ',', '.') }} Orang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
