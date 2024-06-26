@extends('template.main')
@section('title', 'Kegiatan')
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
                                <a href="#" class="btn btn-primary btn-custom"><i class="fa-solid fa-calendar-check"></i>
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
                                        <th>Nama Kegiatan</th>
                                        <th>Proposal</th>
                                        <th>Uraian</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kegiatan as $datakegiatan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="text-align: left;">{{ $datakegiatan->user_name }}</td>
                                            <td style="text-align: left;">{{ $datakegiatan->nama_kegiatan }}</td>
                                            <td>
                                                <a href="{{ Storage::url($datakegiatan->proposal_kegiatan) }}"
                                                    class="btn btn-outline-secondary btn-sm" target="_blank">Unduh File
                                                    PDF</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-secondary btn-sm" data-toggle="modal"
                                                    data-target="#gambarModal{{ $datakegiatan->idkegiatan }}">
                                                    <i class="fa-solid fa-eye"></i> Lihat
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="gambarModal{{ $datakegiatan->idkegiatan }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="gambarModalLabel">Detail
                                                                    Kegiatan</h5>
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
                                                                                {{ $datakegiatan->user_name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">Nama Progam
                                                                                Kerja</th>
                                                                            <td class="text-left">:
                                                                                {{ $datakegiatan->nama_proker }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">Nama
                                                                                Kegiatan</th>
                                                                            <td class="text-left">:
                                                                                {{ $datakegiatan->nama_kegiatan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">
                                                                                Penanggungjawab</th>
                                                                            <td class="text-left">:
                                                                                {{ $datakegiatan->penanggung_jawab }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">
                                                                                Periode</th>
                                                                            <td class="text-left">:
                                                                                {{ $datakegiatan->periode }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">Pengajuan
                                                                                Dana </th>
                                                                            <td class="text-left">:
                                                                                Rp.
                                                                                {{ number_format($datakegiatan->pengajuan_dana, 0, ',', '.') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">Dana
                                                                                Disetujui </th>
                                                                            <td class="text-left">:
                                                                                Rp.
                                                                                {{ number_format($datakegiatan->dana_cair, 0, ',', '.') }}
                                                                            </td>
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
                                                    <?php if ($datakegiatan->status_kegiatan == 'terkirim'): ?>
                                                    <span class="badge badge-light">
                                                        <i class="fa-solid fa-circle-info"></i> Terkirim
                                                    </span>
                                                    <?php elseif ($datakegiatan->status_kegiatan == 'revisibem'): ?>
                                                    <span class="badge badge-warning">
                                                        <i class="fa-solid fa-file-signature"></i>
                                                        Revisi BEM
                                                    </span>
                                                    <?php elseif ($datakegiatan->status_kegiatan == 'revisiukmbem'): ?>
                                                    <span class="badge badge-info">
                                                        <i class="fa-solid fa-file-signature"></i>
                                                        Telah Direvisi UKM
                                                    </span>
                                                    <?php elseif ($datakegiatan->status_kegiatan == 'ajuanukm'): ?>
                                                    @if ($role == 'bem')
                                                        <span class="badge badge-success">
                                                            <i class="fa-solid fa-file-circle-check"></i>
                                                            ACC BEM
                                                        </span>
                                                    @elseif ($role == 'kemahasiswaan')
                                                        <span class="badge badge-light">
                                                            <i class="fa-solid fa-file-signature"></i>
                                                            Ajuan UKM
                                                        </span>
                                                    @endif
                                                    <?php elseif ($datakegiatan->status_kegiatan == 'revisikemahasiswaan'): ?>
                                                    <span class="badge badge-warning">
                                                        <i class="fa-solid fa-file-signature"></i>
                                                        Revisi Kemahasiswaan
                                                    </span>
                                                    <?php elseif ($datakegiatan->status_kegiatan == 'revisiukmkemahasiswaan'): ?>
                                                    <span class="badge badge-info">
                                                        <i class="fa-solid fa-paper-plane"></i>
                                                        Telah Direvisi
                                                    </span>
                                                    <?php elseif ($datakegiatan->status_kegiatan == 'pencairan'): ?>
                                                    <span class="badge badge-primary">
                                                        <i class="fa-solid fa-sack-dollar"></i>
                                                        Pencairan
                                                    </span>
                                                    <?php elseif ($datakegiatan->status_kegiatan == 'selesai'): ?>
                                                    <span class="badge badge-success">
                                                        <i class="fa-regular fa-circle-check"></i>
                                                        Selesai
                                                    </span>
                                                    <?php endif; ?>
                                                </h5>
                                            </td>
                                            <td>
                                                @if ($role == 'bem')
                                                    @if ($datakegiatan->status_kegiatan == 'ajuanukm')
                                                        <form class="d-inline"
                                                            action="/kegiatan/{{ $datakegiatan->idkegiatan }}/edit"
                                                            method="GET">
                                                            <button type="submit" class="btn btn-warning btn-sm mr-1"
                                                                disabled>
                                                                <i class="fa-solid fa-square-pen"></i> Konfirmasi
                                                            </button>
                                                        </form>
                                                    @endif
                                                @elseif ($role == 'kemahasiswaan')
                                                    @if (in_array($datakegiatan->status_kegiatan, ['terkirim', 'revisiukmbem', 'revisiukmkemahasiswaan', 'ajuanukm']))
                                                        <form class="d-inline"
                                                            action="/kegiatan/{{ $datakegiatan->idkegiatan }}/edit"
                                                            method="GET">
                                                            <button type="submit" class="btn btn-warning btn-sm mr-1">
                                                                <i class="fa-solid fa-square-pen"></i> Konfirmasi
                                                            </button>
                                                        </form>
                                                    @elseif (in_array($datakegiatan->status_kegiatan, ['revisibem', 'revisikemahasiswaan', 'pencairan', 'selesai']))
                                                        <form class="d-inline"
                                                            action="/kegiatan/{{ $datakegiatan->idkegiatan }}/edit"
                                                            method="GET">
                                                            <button type="submit" class="btn btn-warning btn-sm mr-1"
                                                                disabled>
                                                                <i class="fa-solid fa-square-pen"></i> Konfirmasi
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                                <form id="delete-form-{{ $datakegiatan->idkegiatan }}" class="d-inline"
                                                    action="/kegiatan/{{ $datakegiatan->idkegiatan }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $datakegiatan->idkegiatan }})">
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
