@extends('template.main')
@section('title', 'Prestasi')
@section('content')

    <div class="content-wrapper">
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
                                            <th>Judul Kegiatan/Lomba</th>
                                            <th>Sertifikat</th>
                                            <th>Dokumentasi</th>
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
                                                    <button class="btn btn-info btn-sm lihat-gambar" data-toggle="modal"
                                                        data-target="#gambarModal{{ $dataprestasi->idprestasi }}">Lihat</button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="gambarModal{{ $dataprestasi->idprestasi }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="gambarModalLabel">Gambar
                                                                        Sertifikat</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img src="{{ Storage::url($dataprestasi->sertifikat) }}"
                                                                        class="img-fluid" alt="Sertifikat Prestasi">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info btn-sm lihat-gambar" data-toggle="modal"
                                                        data-target="#gambarModalDokumentasi{{ $dataprestasi->idprestasi }}">Lihat</button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="gambarModalDokumentasi{{ $dataprestasi->idprestasi }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="gambarModalLabel">Gambar
                                                                        Dokumentasi</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img src="{{ Storage::url($dataprestasi->dokumentasi) }}"
                                                                        class="img-fluid" alt="Dokumentasi Prestasi">
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
                                                            <i class="fa-solid fa-circle-check"></i> Disetujui
                                                        </span>
                                                        <?php elseif ($dataprestasi->statusprestasi == 'ditolak'): ?>
                                                        <span class="badge badge-danger">
                                                            <i class="fa-solid fa-circle-xmark"></i> Ditolak
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
                                                        <button type="submit" class="btn btn-success btn-sm mr-1">
                                                            <i class="fa-solid fa-square-pen"></i> Edit
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
    </div>

@endsection
