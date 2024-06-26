// Event listener untuk menunjukkan tombol ketika halaman di-scroll ke bawah
window.addEventListener('scroll', function() {
    const goTopButton = document.getElementById('goTopButton');
    if (window.scrollY > 100) {
        goTopButton.classList.add('show');
    } else {
        goTopButton.classList.remove('show');
    }
});

// Event listener untuk menggulir ke atas ketika tombol diklik
document.getElementById('goTopButton').addEventListener('click', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
