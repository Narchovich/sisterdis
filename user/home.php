<?php
include '../config/database.php';

$events = mysqli_query($conn,"
SELECT *
FROM events
WHERE status='Available'
ORDER BY event_date ASC
LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - TiketKonser</title>

    <link rel="stylesheet" href="../assets/css/home.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<!-- HERO BANNER -->
<section class="hero">

    <div class="hero-slider">

        <div class="slide active">
            <img src="../assets/images/banner1.png">
        </div>

        <div class="slide">
            <img src="../assets/images/banner2.png">
        </div>

        <div class="slide">
            <img src="../assets/images/banner3.png">
        </div>

        <div class="hero-content">

            <span class="badge">
                Trending Minggu Ini
            </span>

            <h1>
                Gema Suara Fest:
                <br>
                The Grand Tour 2024
            </h1>

            <div class="hero-info">
                <span>24 November 2024</span>
                <span>GBK Jakarta</span>
            </div>

            <a href="events.php" class="btn-primary">
                Beli Tiket Sekarang
            </a>

        </div>

    </div>

</section>

<!-- KATEGORI -->
<section class="category">

    <span>CARI BERDASARKAN :</span>

    <button class="active">Semua</button>
    <button>Pop</button>
    <button>Rock</button>
    <button>Jazz</button>
    <button>Indie</button>
    <button>EDM</button>

</section>

<!-- EVENT POPULER -->
<section class="popular">

    <div class="section-header">
        <div>
            <h2>Event Populer</h2>
            <p>Jangan sampai kehabisan, cek konser paling hits bulan ini.</p>
        </div>

        <a href="events.php">
            Lihat Semua Event →
        </a>
    </div>

    <div class="popular-grid">

        <!-- CARD BESAR KIRI -->
        <div class="featured-card">

            <img src="../assets/images/1.png">

            <div class="overlay">

                <span class="tag">
                    JAZZ NIGHT
                </span>

                <h3>Midnight Jazz Serenade</h3>

                <p>
                    Nikmati malam penuh harmoni.
                </p>

                <div class="price">
                    Rp 750.000
                </div>

                <a href="detail_event.php" class="btn-white">
                    Beli Sekarang
                </a>

            </div>

        </div>

        <!-- CARD BESAR KANAN -->
        <div class="featured-small">

            <img src="../assets/images/2.png">

            <div class="overlay">

                <span class="tag">
                    ROCK
                </span>

                <h3>Rebel Echoes Live</h3>

                <div class="price">
                    Rp 450.000
                </div>

                <a href="detail_event.php">
                    Cek Detail
                </a>

            </div>

        </div>

    </div>

    <!-- EVENT DARI DATABASE -->
    <div class="event-list">

        <?php while($event = mysqli_fetch_assoc($events)) : ?>

            <div class="event-card">

                <img src="../assets/images/<?php echo $event['poster']; ?>">

                <div class="event-body">

                    <h4>
                        <?php echo $event['event_name']; ?>
                    </h4>

                    <p>
                        <?php echo $event['location']; ?>
                    </p>

                    <span class="price">

                        Rp
                        <?php echo number_format($event['regular_price']); ?>

                    </span>

                    <a href="detail_event.php?id=<?php echo $event['id']; ?>">
                        +
                    </a>

                </div>

            </div>

        <?php endwhile; ?>

    </div>

</section>

<!-- WHY US -->
<section class="why-us">

    <h2>Kenapa Beli di TiketKonser?</h2>

    <p>
        Pengalaman membeli tiket yang aman, cepat, dan tanpa ribet.
    </p>

    <div class="why-grid">

        <div class="why-card">
            <h3>100% Aman</h3>
            <p>
                Sistem pembayaran terenkripsi dan tiket terjamin keasliannya.
            </p>
        </div>

        <div class="why-card">
            <h3>Instant & Cepat</h3>
            <p>
                E-ticket langsung dikirim ke email setelah pembayaran.
            </p>
        </div>

        <div class="why-card">
            <h3>Dukungan 24/7</h3>
            <p>
                Tim support siap membantu kapan saja.
            </p>
        </div>

    </div>

</section>

<!-- BANNER PROMO -->
<section class="promo">

    <div class="promo-content">

        <div class="promo-text">

            <h2>
                Nikmati Kemudahan
                <br>
                Dalam Genggaman
            </h2>

            <p>
                Download aplikasi TiketKonser untuk mendapatkan promo eksklusif.
            </p>

        </div>

        <img
            src="../assets/images/banner4.png"
            alt="banner4"
        >

    </div>

</section>

<script>

let slides = document.querySelectorAll('.slide');
let index = 0;

setInterval(() => {

    slides[index].classList.remove('active');

    index++;

    if(index >= slides.length){
        index = 0;
    }

    slides[index].classList.add('active');

}, 5000);

</script>
<?php include '../includes/footer.php'; ?>
</body>
</html>