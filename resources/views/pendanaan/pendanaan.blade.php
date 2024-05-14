@extends('template.main')
@section('title', 'Pendanaan')
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
                                            <th>Anggaran Tersedia</th>
                                            <th>Anggaran Terpakai</th>
                                            <th>Sisa Anggaran</th>
                                            <th>Periode</th>
                                            <th>Status Anggaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendanaan as $datapendanaan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="text-align: left;">{{ $datapendanaan->user_name }}</td>
                                                <td style="text-align: left;">Rp. {{ number_format($datapendanaan->anggaran_tersedia, 0, ',', '.') }}</td>
                                                <td style="text-align: left;">Rp. {{ number_format($datapendanaan->dana_terpakai, 0, ',', '.') }}</td>
                                                <td style="text-align: left;">Rp. {{ number_format($datapendanaan->sisa_anggaran, 0, ',', '.') }}</td>
                                                <td>
                                                    <span class="badge badge-secondary">
                                                        Tahun {{ $datapendanaan->periode }}
                                                    </span>
                                                </td>
                                                {{-- <td>Rp. {{ number_format($data->price, 0) }}</td> --}}
                                                {{-- <td>{{ $data->note }}</td> --}}
                                                <td>
                                                    <button type="submit" class="btn btn-success btn-sm mr-1">
                                                        <i class="fa-solid fa-circle-check"></i> {{ $datapendanaan->status_anggaran }}
                                                    </button>
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
