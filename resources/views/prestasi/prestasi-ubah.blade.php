@extends('template.main')
@section('title', 'Ubah Prestasi')
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
                        <li class="breadcrumb-item"><a href="/prestasi">Prestasi</a></li>
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
                                <a href="/prestasi" class="btn btn-warning btn-sm"><i
                                        class="fa-solid fa-arrow-rotate-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <form class="needs-validation" novalidate id="submit-form-{{ $prestasi_ubah->idprestasi }}" action="/prestasi/{{ $prestasi_ubah->idprestasi }}"
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
                                                placeholder="Name User" value="{{ old('name', $prestasi_ubah->name) }}"
                                                readonly>
                                            @error('name')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="category">Nama Lomba</label>
                                            <input type="text" name="namalomba"
                                                class="form-control @error('namalomba') is-invalid @enderror"
                                                id="kategorilomba" placeholder="Masukkan Nama Lengkap"
                                                value="{{ old('namalomba', $prestasi_ubah->namalomba) }}" readonly>
                                            @error('ketua')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="category">Alasan Ditolak
                                            </label>
                                            <textarea name="note" class="form-control @error('note') is-invalid @enderror"id="kategorilomba"
                                                placeholder="Masukkan Alasan Anda..." rows="4s">{{ old('note', $prestasi_ubah->notei) }}</textarea>
                                            <i style="color: red; font-size:11pt">*Silahkan sertakan alasan Anda jika data
                                                prestasi tidak valid. Kosongi jika telah valid.</i>
                                            @error('note')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">File Sertifikat</label>
                                            <input type="file" name="sertifikat"
                                                class="form-control @error('sertifikat') is-invalid @enderror"
                                                id="sertifikat" placeholder="File">
                                            @error('sertifikat')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">File Dokumentasi</label>
                                            <input type="file" name="dokumentasi"
                                                class="form-control @error('dokumentasi') is-invalid @enderror"
                                                id="dokumentasi" placeholder="File">
                                            @error('dokumentasi')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            {{-- <label for="status_prestasi">Status Prestasi</label> --}}
                                            <select type="hidden" style="display: none" class="custom-select"
                                                id="status_prestasi" name="status_prestasi">
                                                <option value="disetujui"
                                                    {{ $prestasi_ubah->statusprestasi == 'disetujui' ? 'selected' : '' }}>
                                                    Disetujui</option>
                                                <option value="ditolak"
                                                    {{ $prestasi_ubah->statusprestasi == 'ditolak' ? 'selected' : '' }}>
                                                    Ditolak</option>
                                            </select>
                                            @error('status_prestasi')
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
                        <button class="btn btn-success" type="button"
                            onclick="confirmSave('{{ $prestasi_ubah->idprestasi }}')">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Save</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- /.content -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSave(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin, data yang akan diubah sudah benar?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#5F7C5D',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('submit-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
