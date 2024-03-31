<div>
    <h2>Halo, {{$nama}}</h2>
    <h4>Selamat datang di halaman Profil Murid</h4>
    <p>Mata Kuliah</p>
    <ul>
        @foreach ($matkul as $mt)
            <li>{{$mt}}</li>
        @endforeach
    </ul>
 </div>
