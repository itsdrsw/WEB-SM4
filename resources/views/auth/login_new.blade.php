<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKMAS POLIJE</title>
    <link rel="stylesheet" href="/assets/assets_login/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400;1,700&amp;family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet" />
    <script src="https://kit.fontawesome.com/40389235ff.js" crossorigin="anonymous"></script>
</head>

<body>
    @include('sweetalert::alert')
    <div class="container">
        <div class="signin">
            <h2>SELAMAT DATANG DI</h2>
            <h2>SIKMAS POLIJE</h2>
            <p>Pengajuan kegiatan lebih mudah, proses revisi tidak bikin lelah, kegiatan terlaksana lebih terarah.</p>
            <!-- <button>Sign In</button> -->
        </div>
        <div class="signup">
            <h2>LOGIN</h2>
            <div class="social-buttons">
                <p>Silahkan masukkan email dan password Anda!</p>
            </div>
            <form class="needs-validation" action="/login" method="POST">
                @csrf
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Masukkan Email Anda" required>
                </div>
                <div class="input-container">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Masukkan Password Anda" required>
                    <button type="button" onclick="togglePasswordVisibility()"><i class="fa-solid fa-eye"></i></button>
                </div>
                <div class="button-container">
                    <button type="submit"><b>LOGIN</b></button>
                </div>
            </form>
        </div>
    </div>
    <footer class="footer">
            <p>&copy; 2024 SAE TEAM. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const toggleButton = passwordField.nextElementSibling;

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleButton.innerHTML = '<i class="fa-solid fa-eye-slash"></i>'; // Eye closed icon
            } else {
                passwordField.type = 'password';
                toggleButton.innerHTML = '<i class="fa-solid fa-eye"></i>'; // Eye open icon
            }
        }
    </script>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>
