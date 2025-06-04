document.addEventListener('DOMContentLoaded', function() {
    const newsTicker = document.getElementById('news-ticker');

    // Pastikan newsTicker ditemukan sebelum melanjutkan
    if (!newsTicker) {
        console.error("Elemen #news-ticker tidak ditemukan di DOM.");
        return; // Hentikan eksekusi jika elemen tidak ada
    }

    const tickerContainer = newsTicker.parentElement; 

    // Periksa juga tickerContainer, meskipun seharusnya selalu ada jika newsTicker ada
    if (!tickerContainer) {
        console.error("Wadah parent dari #news-ticker tidak ditemukan.");
        return;
    }

    let animationId; // Untuk menyimpan requestAnimationFrame ID

    function startTickerAnimation() {
        // Duplikasi konten untuk looping mulus
        // Pastikan Anda hanya menduplikasi sekali saat startTickerAnimation dipanggil pertama kali
        // Atau pastikan DOM bersih sebelum menduplikasi lagi jika fungsi ini dipanggil berulang
        if (newsTicker.dataset.duplicated !== 'true') { // Tambahkan flag untuk mencegah duplikasi berulang
            newsTicker.innerHTML += newsTicker.innerHTML; 
             newsTicker.dataset.duplicated = 'true'; // Set flag
        }

        let position = 0;
        const speed = 0.5; // Sesuaikan kecepatan sesuai keinginan

        function animateTicker() {
            position -= speed; // Geser ke kiri

            // Jika setengah dari konten terduplikasi sudah melewati batas, reset posisi
            if (Math.abs(position) >= newsTicker.scrollWidth / 2) {
                position = 0; // Reset ke awal
            }
            newsTicker.style.transform = `translateX(${position}px)`;
            animationId = requestAnimationFrame(animateTicker);
        }

        animateTicker(); // Mulai animasi
    }

    // Panggil fungsi startTickerAnimation saat DOM selesai dimuat
    startTickerAnimation();

    // Opsional: Pause/Play on hover
    // Jika Anda mengaktifkan ini, pastikan elemen newsTicker benar-benar ada
    // newsTicker.addEventListener('mouseenter', () => {
    //     cancelAnimationFrame(animationId);
    // });
    // newsTicker.addEventListener('mouseleave', () => {
    //     // Untuk melanjutkan, kita perlu memanggil startTickerAnimation lagi,
    //     // tapi pastikan tidak menduplikasi konten lagi jika sudah
    //     startTickerAnimation(); 
    // });
});