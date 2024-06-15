@extends('template.main')
@section('title', 'LPJ')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('title')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-right">
                                <a href="/barang/create" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover text-center"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Ormawa</th>
                                        <th>Nama Proker</th>
                                        <th>Lampiran</th>
                                        <th>Uraian</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lpj as $datalpj)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="text-align: left;">{{ $datalpj->user_name }}</td>
                                            <td style="text-align: left;">{{ $datalpj->nama_proker }}</td>
                                            <td>
                                                <a href="{{ Storage::url($datalpj->file_lpj) }}"
                                                    class="btn btn-outline-secondary btn-sm" target="_blank">Unduh File
                                                    PDF</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                    data-target="#gambarModal{{ $datalpj->idlpj }}">
                                                    <i class="fa-solid fa-eye"></i> Lihat
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="gambarModal{{ $datalpj->idlpj }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="gambarModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="gambarModalLabel">Detail
                                                                    Progam Kerja</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table
                                                                    class="table table-borderless table-striped-columns mt-3">
                                                                    <tbody style="pointer-events: none;">
                                                                        <tr>
                                                                            <th scope="row" class="text-left">Nama Ormawa
                                                                            </th>
                                                                            <td class="text-left">:
                                                                                {{ $datalpj->user_name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">Nama Progam
                                                                                Kerja</th>
                                                                            <td class="text-left">:
                                                                                {{ $datalpj->nama_proker }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">
                                                                                Penanggungjawab</th>
                                                                            <td class="text-left">:
                                                                                {{ $datalpj->penanggung_jawab }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">
                                                                                Periode</th>
                                                                            <td class="text-left">:
                                                                                {{ $datalpj->periode }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">Uraian
                                                                                Proker</th>
                                                                            <td class="text-left">:
                                                                                {{ $datalpj->uraian_proker }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5>
                                                    <?php if ($datalpj->status_lpj == 'terkirim'): ?>
                                                    <span class="badge badge-light">
                                                        <i class="fa-solid fa-circle-info"></i> Terkirim
                                                    </span>
                                                    <?php elseif ($datalpj->status_lpj == 'revisi'): ?>
                                                    <span class="badge badge-warning">
                                                        <i class="fa-solid fa-file-signature"></i>
                                                        Revisi
                                                    </span>
                                                    <?php elseif ($datalpj->status_lpj == 'perbaikan revisi'): ?>
                                                    <span class="badge badge-warning">
                                                        <i class="fa-solid fa-file-pen"></i>
                                                        Telah Direvisi
                                                    </span>
                                                    <?php elseif ($datalpj->status_lpj == 'disetujui'): ?>
                                                    <span class="badge badge-success">
                                                        <i class="fa-regular fa-circle-check"></i>
                                                        Disetujui
                                                    </span>
                                                    <?php endif; ?>
                                                </h5>
                                            </td>
                                            {{-- <td>Rp. {{ number_format($data->price, 0) }}</td> --}}
                                            {{-- <td>{{ $data->note }}</td> --}}
                                            <td>
                                                <?php if ($datalpj->status_lpj == 'terkirim' ||
                                                $datalpj->status_lpj == 'perbaikan revisi'): ?>
                                                <form class="d-inline" action="/lpj/{{ $datalpj->idlpj }}/edit"
                                                    method="GET">
                                                    <button type="submit" class="btn btn-warning btn-sm mr-1">
                                                        <i class="fa-solid fa-square-pen"></i> Konfirmasi
                                                    </button>
                                                    <?php elseif ($datalpj->status_lpj == 'disetujui' ||
                                                    $datalpj->status_lpj == 'revisi'): ?>
                                                    <form class="d-inline" action="/lpj/{{ $datalpj->idlpj }}/edit"
                                                        method="GET">
                                                        <button type="submit" class="btn btn-warning btn-sm mr-1" disabled>
                                                            <i class="fa-solid fa-square-pen"></i> Konfirmasi
                                                        </button>
                                                    </form>
                                                    <?php endif; ?>
                                                    <form class="d-inline" action="/lpj/{{ $datalpj->idlpj }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            id="btn-delete"><i class="fa-solid fa-trash-can"></i> Delete
                                                        </button>
                                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
    </div>

@endsection
