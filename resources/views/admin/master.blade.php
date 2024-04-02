<!DOCTYPE html>
<html>
<head>
  <title>Belajar Sistem Blade Template Laravel - Ayo Ngoding</title>
</head>
<body>
  <header>
    <h2>Blog Ayo Ngoding</h2>
    <nav>
      <a href="/">HOME</a>
      |
      <a href="/tentang">TENTANG</a>
      |
      <a href="/kontak">KONTAK</a>
    </nav>
  </header>
  <hr/>
  <br/>
  <br/>
  <main>

  <!-- bagian ini menampung konten blog -->
  @yield('konten')

  </main>

  <br/>
  <br/>
  <hr/>
  <footer>
    <p>Copyright &copy; 2019 - 2021 <a href="https://www.ayongoding.com/">www.ayongoding.com</a></p>
  </footer>
</body>
</html>
