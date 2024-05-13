@extends('template.main')
@section('title', 'Prestasi')
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
                                            <th style="width: 5%">No.</th>
                                            <th>Ormawa</th>
                                            <th>Judul Kegiatan/Lomba</th>
                                            <th>Detail</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prestasi as $dataprestasi)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="text-align: left;">{{ $dataprestasi->name }}</td>
                                                <td style="text-align: left;">{{ $dataprestasi->namalomba }}</td>
                                                <td>
                                                    <button class="btn btn-outline-info btn-sm lihat-gambar" data-toggle="modal"
                                                        data-target="#gambarModal{{ $dataprestasi->idprestasi }}">
                                                        <i class="fa-solid fa-eye"></i> Lihat
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="gambarModal{{ $dataprestasi->idprestasi }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="gambarModalLabel">Detail
                                                                        Prestasi</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table
                                                                        class="table table-borderless table-striped-columns mt-3">
                                                                        <tbody style="pointer-events: none;">
                                                                            <tr>
                                                                                <th scope="row" class="text-left">Nama
                                                                                    Ormawa</th>
                                                                                <td class="text-left">:
                                                                                    {{ $dataprestasi->name }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-left">
                                                                                    Kategori Lomba</th>
                                                                                <td class="text-left">:
                                                                                    {{ $dataprestasi->kategorilomba }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-left">Nama
                                                                                    Lomba</th>
                                                                                <td class="text-left">:
                                                                                    {{ $dataprestasi->namalomba }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-left">Juara
                                                                                </th>
                                                                                <td class="text-left">:
                                                                                    {{ $dataprestasi->juara }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-left">
                                                                                    Penyelenggara</th>
                                                                                <td class="text-left">:
                                                                                    {{ $dataprestasi->penyelenggara }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-left">Lingkup
                                                                                </th>
                                                                                <td class="text-left">:
                                                                                    {{ $dataprestasi->lingkup }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-left">Tanggal
                                                                                    dan Waktu</th>
                                                                                <td class="text-left">:
                                                                                    {{ old('tanggal_waktu', \Carbon\Carbon::parse($dataprestasi->tanggallomba)->format('j F Y \| h:i A')) }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-left">
                                                                                    Sertifikat</th>
                                                                                <td colspan="2"><img
                                                                                        src="{{ Storage::url($dataprestasi->sertifikat) }}"
                                                                                        class="img-fluid mt-4"
                                                                                        alt="Dokumentasi Prestasi"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-left">
                                                                                    Dokumentasi</th>
                                                                                <td colspan="2"><img
                                                                                        src="{{ Storage::url($dataprestasi->dokumentasi) }}"
                                                                                        class="img-fluid mt-4"
                                                                                        alt="Dokumentasi Prestasi"></td>
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
                                                        <?php if ($dataprestasi->statusprestasi == 'belum disetujui'): ?>
                                                        <span class="badge badge-warning">
                                                            <i class="fa-solid fa-circle-info"></i> Belum Disetujui
                                                        </span>
                                                        <?php elseif ($dataprestasi->statusprestasi == 'disetujui'): ?>
                                                        <span class="badge badge-success">
                                                            <i class="fa-regular fa-circle-check"></i>
                                                            Disetujui
                                                        </span>
                                                        <?php elseif ($dataprestasi->statusprestasi == 'ditolak'): ?>
                                                        <span class="badge badge-danger">
                                                            <i class="fa-regular fa-circle-xmark"></i>
                                                            Ditolak
                                                        </span>
                                                        <?php endif; ?>
                                                    </h5>
                                                </td>
                                                {{-- <td>Rp. {{ number_format($data->price, 0) }}</td> --}}
                                                {{-- <td>{{ $data->note }}</td> --}}
                                                <td>
                                                    <form class="d-inline"
                                                        action="/prestasi/{{ $dataprestasi->idprestasi }}/edit"
                                                        method="GET">
                                                        <button type="submit" class="btn btn-warning btn-sm mr-1">
                                                            <i class="fa-solid fa-square-pen"></i> Konfirmasi
                                                        </button>
                                                    </form>
                                                    <form class="d-inline" action="/profil/{{ $dataprestasi->id_user }}"
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
