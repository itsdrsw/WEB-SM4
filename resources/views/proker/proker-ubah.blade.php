@extends('template.main')
@section('title', 'Ubah Progam Kerja')
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
                        <li class="breadcrumb-item"><a href="/proker">Progam Kerja</a></li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-right">
                                <a href="/proker" class="btn btn-warning btn-sm"><i
                                        class="fa-solid fa-arrow-rotate-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <form class="needs-validation" novalidate action="/proker/{{ $proker_ubah->idproker }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Nama Ormawa</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                placeholder="Name User" value="{{ old('name', $proker_ubah->name) }}"
                                                readonly>
                                            @error('name')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="category">Penanggungjawab</label>
                                            <input type="text" name="penanggung_jawab"
                                                class="form-control @error('penanggung_jawab') is-invalid @enderror"
                                                id="penanggung_jawab" placeholder="Masukkan nama proker"
                                                value="{{ old('penanggung_jawab', $proker_ubah->penanggung_jawab) }}"
                                                readonly>
                                            @error('ketua')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="statusproker">Status Progam Kerja</label>
                                            <select class="custom-select" id="statusproker" name="status_proker">
                                                <option value="disetujui" {{ $proker_ubah->status_proker == 'disetujui' ? 'selected' : '' }}>
                                                    Disetujui
                                                </option>
                                                <option value="ditolak" {{ $proker_ubah->status_proker == 'ditolak' ? 'selected' : '' }}>
                                                    Ditolak
                                                </option>
                                            </select>
                                            @error('status_proker')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">File TOR</label>
                                            <input type="file" name="lampiran_proker"
                                                class="form-control @error('lampiran_proker') is-invalid @enderror"
                                                id="lampiran_proker" placeholder="File" accept="application/pdf">
                                            @error('lampiran_proker')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-dark mr-1" type="reset"><i class="fa-solid fa-arrows-rotate"></i>
                            Reset</button>
                        <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk"></i>
                            Save</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- /.content -->
        </div>
    </div>
    </div>

@endsection
