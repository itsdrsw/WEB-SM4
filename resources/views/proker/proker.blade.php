@extends('template.main')
@section('title', 'Progam Kerja')
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
                                        <th>Nama Progam Kerja</th>
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
                                                <button class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#gambarModal{{ $dataproker->idprestasi }}">
                                                    <i class="fa-solid fa-eye"></i> Lihat
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="gambarModal{{ $dataproker->idprestasi }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel"
                                                    aria-hidden="true">
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
                                                                            <th scope="row" class="text-left">Nama Ormawa</th>
                                                                            <td class="text-left">:
                                                                                {{ $dataproker->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">Nama Progam Kerja</th>
                                                                            <td class="text-left">:
                                                                                {{ $dataproker->nama_proker }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-left">Penanggungjawab</th>
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
                                                <img src="" alt="">
                                            </td>
                                            <td>
                                                <h5>
                                                    <?php if ($dataproker->status_proker == 'Terkirim'): ?>
                                                    <span class="badge badge-warning">
                                                        <i class="fa-solid fa-circle-info"></i> Terkirim
                                                    </span>
                                                    <?php elseif ($dataproker->status_proker == 'Disetujui'): ?>
                                                    <span class="badge badge-success">
                                                        <i class="fa-regular fa-circle-check"></i>
                                                        Disetujui
                                                    </span>
                                                    <?php elseif ($dataproker->status_proker == 'Ditolak'): ?>
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
                                                <form class="d-inline" action="/proker/{{ $dataproker->id_user }}/edit"
                                                    method="GET">
                                                    <button type="submit" class="btn btn-success btn-sm mr-1">
                                                        <i class="fa-solid fa-square-pen"></i> Edit
                                                    </button>
                                                </form>
                                                <form class="d-inline" action="/proker/{{ $dataproker->id_user }}"
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
