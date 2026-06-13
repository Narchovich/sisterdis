<?php

if(isset($_POST['kirim'])){

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $subjek = $_POST['subjek'];
    $pesan = $_POST['pesan'];

    $query = "INSERT INTO pesan_kontak
              (nama, email, subjek, pesan)
              VALUES
              ('$nama','$email','$subjek','$pesan')";

    mysqli_query($conn, $query);

    echo "<script>alert('Pesan berhasil dikirim');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - TiketKonser</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<section class="contact-section">

    <div class="contact-header">
        <h1>Ada Pertanyaan?</h1>
        <p>
            Tim kami siap membantu Anda 24/7. Pilih saluran komunikasi yang paling
            nyaman bagi Anda.
        </p>
    </div>

    <div class="contact-container">

        <!-- Kiri -->
        <div class="left-content">

            <!-- Kontak -->
            <div class="contact-cards">

                <div class="contact-card">
                    <div class="icon whatsapp">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <h3>WhatsApp</h3>
                    <p>Respon cepat untuk pertanyaan tiket dan jadwal event.</p>
                    <a href="#">Chat Sekarang →</a>
                </div>

                <div class="contact-card">
                    <div class="icon email">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h3>Email</h3>
                    <p>Kirimkan penawaran kerjasama atau keluhan teknis.</p>
                    <a href="#">support@tiketkonser.com →</a>
                </div>

            </div>

            <!-- Sosial Media -->
            <div class="social-box">
                <h3>Media Sosial</h3>

                <div class="social-list">

                    <div class="social-item">
                        <div class="circle">
                            <i class="bi bi-instagram"></i>
                        </div>
                        <span>Instagram</span>
                    </div>

                    <div class="social-item">
                        <div class="circle">
                            <i class="bi bi-facebook"></i>
                        </div>
                        <span>Facebook</span>
                    </div>

                    <div class="social-item">
                        <div class="circle">
                            <i class="bi bi-twitter-x"></i>
                        </div>
                        <span>X (Twitter)</span>
                    </div>

                </div>
            </div>

            <!-- Lokasi -->
            <div class="office-card">

                <div class="office-image">
                    <div class="overlay">
                        <small>KANTOR PUSAT</small>
                        <h3>Sudirman Central Business District</h3>
                    </div>
                </div>

                <div class="office-info">
                    <p>
                        <i class="bi bi-geo-alt"></i>
                        Gedung High-Rise Lt. 24, Jl. Jend. Sudirman Kav 52–53,
                        Jakarta Selatan, 12190
                    </p>

                    <a href="#">
                        Lihat di Google Maps
                        <i class="bi bi-map"></i>
                    </a>
                </div>

            </div>

        </div>

        <!-- Kanan -->
        <div class="contact-form">

            <h2>Kirim Pesan</h2>

            <form>

                <label>Nama Lengkap</label>
                <input type="text" placeholder="Contoh: Budi Santoso">

                <label>Email</label>
                <input type="email" placeholder="budi@email.com">

                <label>Subjek</label>
                <select>
                    <option>Masalah Tiket</option>
                    <option>Pembayaran</option>
                    <option>Kerjasama</option>
                </select>

                <label>Pesan</label>
                <textarea rows="5" placeholder="Ceritakan kebutuhan Anda..."></textarea>

                <button type="submit" name="kirim">
                    Kirim Sekarang
                </button>

            </form>

        </div>

    </div>

</section>


<?php include '../includes/footer.php'; ?>
</body>
</html>