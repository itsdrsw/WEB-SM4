@extends('template.main')
@section('title', 'Program Kerja')
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
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
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
                            <div class="text-left">
                                <a href="#" class="btn btn-primary btn-custom"><i class="fa-solid fa-book-open"></i>
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
                                        <th>Nama Program Kerja</th>
                                        <th>Uraian</th>
                                        <th>Lampiran</th>
                                        <th>Status Proker</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proker as $dataproker)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="text-align: left;">{{ $dataproker->name }}</td>
                                            <td style="text-align: left;">{{ $dataproker->nama_proker }}</td>
                                            <td>
                                                <button class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                    data-target="#gambarModal{{ $dataproker->idproker }}">
                                                    <i class="fa-solid fa-eye"></i> Lihat
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="gambarModal{{ $dataproker->idproker }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="gambarModalLabel">Detail
                                                                    Program Kerja</h5>
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
                                                                                {{ $dataproker->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">Nama
                                                                                Program Kerja</th>
                                                                            <td class="text-left">:
                                                                                {{ $dataproker->nama_proker }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">
                                                                                Penanggungjawab</th>
                                                                            <td class="text-left">:
                                                                                {{ $dataproker->penanggung_jawab }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">
                                                                                Periode</th>
                                                                            <td class="text-left">:
                                                                                {{ $dataproker->periode }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">Uraian
                                                                                Proker</th>
                                                                            <td class="text-left">:
                                                                                {{ $dataproker->uraian_proker }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ Storage::url($dataproker->lampiran_proker) }}"
                                                    class="btn btn-outline-secondary btn-sm" target="_blank">Unduh File
                                                    PDF</a>
                                            </td>
                                            <td>
                                                <h5>
                                                    <?php if ($dataproker->status_proker == 'terkirim'): ?>
                                                    <span class="badge badge-light">
                                                        <i class="fa-solid fa-circle-info"></i> Terkirim
                                                    </span>
                                                    <?php elseif ($dataproker->status_proker == 'disetujui'): ?>
                                                    <span class="badge badge-success">
                                                        <i class="fa-regular fa-circle-check"></i>
                                                        Disetujui
                                                    </span><?php elseif ($dataproker->status_proker == 'perbaikanrevisi'): ?>
                                                    <span class="badge badge-info">
                                                        <i class="fa-solid fa-file-signature"></i>
                                                        Telah Direvisi
                                                    </span>
                                                    <?php elseif ($dataproker->status_proker == 'revisi'): ?>
                                                    <span class="badge badge-warning">
                                                        <i class="fa-solid fa-file-signature"></i>
                                                        Revisi
                                                    </span>
                                                    <?php endif; ?>
                                                </h5>
                                            </td>
                                            {{-- <td>Rp. {{ number_format($data->price, 0) }}</td> --}}
                                            {{-- <td>{{ $data->note }}</td> --}}
                                            <td>
                                                <?php if ($dataproker->status_proker == 'terkirim' ||
                                                $dataproker->status_proker == 'perbaikanrevisi'): ?>
                                                <form class="d-inline" action="/proker/{{ $dataproker->idproker }}/edit"
                                                    method="GET">
                                                    <button type="submit" class="btn btn-warning btn-sm mr-1">
                                                        <i class="fa-solid fa-square-pen"></i> Konfirmasi
                                                    </button>
                                                </form>
                                                <?php elseif ($dataproker->status_proker == 'disetujui' ||
                                                $dataproker->status_proker == 'revisi'): ?>
                                                <form class="d-inline" action="/proker/{{ $dataproker->idproker }}/edit"
                                                    method="GET">
                                                    <button type="submit" class="btn btn-warning btn-sm mr-1" disabled>
                                                        <i class="fa-solid fa-square-pen"></i> Konfirmasi
                                                    </button>
                                                </form>
                                                <?php endif; ?>
                                                <form id="delete-form-{{ $dataproker->idproker }}" class="d-inline"
                                                    action="/proker/{{ $dataproker->idproker }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $dataproker->idproker }})">
                                                        <i class="fa-solid fa-trash-can"></i> Hapus
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin, data ini akan dihapus secara permanen?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#5F7C5D',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
