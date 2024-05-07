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
                                            <th>Detail</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prestasi as $dataprestasi)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="text-align: left;">{{ $dataprestasi->name}}</td>
                                                <td style="text-align: left;">{{ $dataprestasi->namalomba }}</td>
                                                <td>
                                                    <img src="" alt="">
                                                </td>
                                                <td>
                                                    <img src="" alt="">
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-info btn-sm mr-1">
                                                        <i class="fa-solid fa-circle-info"></i> Lihat Detail
                                                    </button>
                                                </td>
                                                {{-- <td>Rp. {{ number_format($data->price, 0) }}</td> --}}
                                                {{-- <td>{{ $data->note }}</td> --}}
                                                <td>
                                                    <form class="d-inline" action="/prestasi/{{ $dataprestasi->idprestasi }}/edit"
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
