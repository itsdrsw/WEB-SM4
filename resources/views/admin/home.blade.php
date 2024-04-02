<!-- Menghubungkan dengan view template master -->
@extends('admin.master')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul', 'Halaman Home')

<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')

  <p>Selamat datang!</p>
  <p>Ini Adalah Halaman Home - Belajar Sistem Blade Template Laravel</p>

@endsection
