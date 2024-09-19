@extends('template-user.index')

@section('content-user')

<!-- Page Header -->
<div class="page-header">
    <div class="content-page-header">
        <h5>Notifikasi & Informasi</h5>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#favorite" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            Favorite <span class="badge bg-warning">{{ count($penting) }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#informasi" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                            Informasi <span class="badge bg-secondary">{{ count($informasi) }}</span>
                        </a>
                    </li>
                </ul>
                <!-- /Nav Tabs -->

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Favorite Tab -->
                    <div class="tab-pane" id="favorite">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-table">
                                    <div class="card-body">
                                        @foreach ($penting as $data)
                                            <div class="table-responsive mb-3">
                                                <table class="table mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th width="80%">
                                                                <h6>{{ strtoupper($data->nama_informasi) }}</h6>
                                                            </th>
                                                            <th><span>{{ $data->created_at->diffForHumans() }}</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td width="80%">
                                                                <span class="text-muted">Deskripsi : </span>{{ $data->deskripsi }} <br>
                                                                <span class="text-muted">{{ $data->created_at->isoFormat('dddd, D MMMM Y') }}</span>
                                                            </td>
                                                            <td class="text-right">
                                                                @if ($data->jenis_informasi == 'File')
                                                                    <a href="{{ route('user-download-informasi', $data->file_informasi) }}" class="btn btn-greys me-2">
                                                                        <i class="fe fe-download me-2"></i> Download File
                                                                    </a>
                                                                    <a href="{{ route('user-open-file', $data->file_informasi) }}" class="btn btn-greys me-2" target="_blank">
                                                                        <i class="fe fe-download me-2"></i> Open File
                                                                    </a>
                                                                @elseif ($data->jenis_informasi == 'Link')
                                                                    <a href="{{ $data->link_informasi }}" class="btn btn-greys me-2" target="_blank">
                                                                        <i class="fe fe-link me-2"></i> Link Informasi
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Favorite Tab -->

                    <!-- Informasi Tab -->
                    <div class="tab-pane show active" id="informasi">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-table">
                                    <div class="card-body">
                                        @foreach ($informasi as $data)
                                            <div class="table-responsive mb-3">
                                                <table class="table mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th width="80%">
                                                                <h6>{{ strtoupper($data->nama_informasi) }}</h6>
                                                            </th>
                                                            <th><span>{{ $data->created_at->diffForHumans() }}</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td width="80%">
                                                                <span class="text-muted">Deskripsi :</span> {{ $data->deskripsi }} <br>
                                                                <span class="text-muted">{{ $data->created_at->isoFormat('dddd, D MMMM Y') }}</span>
                                                            </td>
                                                            <td class="text-right">
                                                                @if ($data->jenis_informasi == 'File')
                                                                    <a href="{{ route('user-download-informasi', $data->file_informasi) }}" class="btn btn-greys me-2">
                                                                        <i class="fe fe-download me-2"></i> Download File
                                                                    </a>
                                                                    <a href="{{ route('user-open-file', $data->file_informasi) }}" class="btn btn-greys me-2" target="_blank">
                                                                        <i class="fe fe-eye me-2"></i> Open File
                                                                    </a>
                                                                @elseif ($data->jenis_informasi == 'Link')
                                                                    <a href="{{ $data->link_informasi }}" class="btn btn-greys me-2" target="_blank">
                                                                        <i class="fe fe-link me-2"></i> Link Informasi
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Informasi Tab -->
                </div>
                <!-- /Tab Content -->

            </div>
        </div>
    </div>
</div>


@endsection
