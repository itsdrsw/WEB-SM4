<!-- Menghubungkan dengan view template master -->
@extends('admin.master')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul', 'Halaman Kontak')

<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')

  <p>Ini Adalah Halaman Kontak</p>

  <table border="1" cellpadding="3" cellspacing="0">
    <tr>
      <td>Email</td>
      <td>:</td>
      <td>info@ayongoding.com</td>
    </tr>
    <tr>
      <td>Facebook</td>
      <td>:</td>
      <td>facebook/ayongoding</td>
    </tr>
    <tr>
      <td>Twitter</td>
      <td>:</td>
      <td>twitter/ayongoding</td>
    </tr>
    <tr>
      <td>Hp</td>
      <td>:</td>
      <td>0853-6411-6655</td>
    </tr>
  </table>

@endsection
