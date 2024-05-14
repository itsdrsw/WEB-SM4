@extends('template.main')
@section('title', 'Ubah Kegiatan')
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
                        <li class="breadcrumb-item"><a href="/kegiatan">Kegiatan</a></li>
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
                                <a href="/kegiatan" class="btn btn-warning btn-sm"><i
                                        class="fa-solid fa-arrow-rotate-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <form class="needs-validation" novalidate action="/kegiatan/{{ $kegiatan_ubah->idkegiatan }}"
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
                                                placeholder="Name User" value="{{ old('name', $kegiatan_ubah->user_name) }}"
                                                readonly>
                                            @error('name')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="category">Nama Kegiatan</label>
                                            <input type="text" name="penanggung_jawab"
                                                class="form-control @error('penanggung_jawab') is-invalid @enderror"
                                                id="penanggung_jawab" placeholder="Masukkan nama proker"
                                                value="{{ old('penanggung_jawab', $kegiatan_ubah->nama_kegiatan) }}"
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
                                            <label for="status_kegiatan">Status Kegiatan</label>
                                            <select class="custom-select" id="status_kegiatan" name="status_kegiatan">
                                                <option value="revisi"
                                                    {{ $kegiatan_ubah->status_kegiatan == 'revisi' ? 'selected' : '' }}>
                                                    Revisi</option>
                                                <option value="pencairan"
                                                    {{ $kegiatan_ubah->status_kegiatan == 'pencairan' ? 'selected' : '' }}>
                                                    Pencairan</option>
                                                <option value="selesai"
                                                    {{ $kegiatan_ubah->status_kegiatan == 'selesai' ? 'selected' : '' }}>
                                                    Selesai</option>
                                            </select>
                                            @error('status_kegiatan')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="proposal_kegiatan">Proposal Kegiatan</label>
                                            <input type="file" name="proposal_kegiatan"
                                                class="form-control @error('proposal_kegiatan') is-invalid @enderror"
                                                id="proposal_kegiatan" placeholder="File" accept="application/pdf">
                                            @error('proposal_kegiatan')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name">Dana Disetujui</label>
                                            <input type="number" name="dana_cair"
                                                class="form-control @error('dana_cair') is-invalid @enderror" id="name"
                                                placeholder="Masukkan nominal dana" value="{{ old('dana_cair', $kegiatan_ubah->dana_cair) }}">
                                            @error('dana_cair')
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
