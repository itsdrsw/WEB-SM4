<div>
    <h3>Form Pendaftaran Murid</h3>
    <form action="pendaftaran/proses" method="post">
        {{ csrf_field() }}
        Nama : <input type="text" name="nama" placeholder="Masukkan Nama Anda">
        <br><br>
        Alamat : <input type="text" name="alamat">
        <br><br>
        <input type="submit" name="kirim" value="Kirim">
    </form>
</div>
