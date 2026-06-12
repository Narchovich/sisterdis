<?php
include '../config/database.php';

$events = mysqli_query($conn,"
SELECT *
FROM events
ORDER BY event_date ASC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Semua Event - TiketKonser</title>

<link rel="stylesheet" href="../assets/css/events.css">

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>

<body>

<?php include '../includes/navbar.php'; ?>

<main class="events-container">

    <header class="page-header">
        <h1>Semua Event Seru</h1>

        <p>
            Temukan konser musisi favoritmu dan amankan tiketnya
            sebelum kehabisan. Pengalaman musik yang tak terlupakan
            menantimu.
        </p>
    </header>

    <section class="toolbar">

        <div class="search-box">

            <span class="material-symbols-outlined">
                search
            </span>

            <input
                type="text"
                placeholder="Cari konser, artis, atau genre..."
            >

        </div>

        <div class="genre-filter">

            <button class="active">
                Semua Genre
            </button>

            <button>Pop</button>
            <button>Rock</button>
            <button>Jazz</button>
            <button>Electronic</button>

        </div>

    </section>

    <section class="event-grid">

        <?php if(mysqli_num_rows($events) > 0): ?>

            <?php while($event = mysqli_fetch_assoc($events)): ?>

                <div class="event-card">

                    <div class="event-image">

                        <img
                            src="../assets/images/<?php echo $event['poster']; ?>"
                            alt="<?php echo $event['event_name']; ?>"
                        >

                        <span class="status">
                            <?php echo $event['status']; ?>
                        </span>

                    </div>

                    <div class="event-content">

                        <h3>
                            <?php echo $event['event_name']; ?>
                        </h3>

                        <div class="meta">

                            <div>
                                <span class="material-symbols-outlined">
                                    location_on
                                </span>

                                <?php echo $event['location']; ?>
                            </div>

                            <div>
                                <span class="material-symbols-outlined">
                                    calendar_today
                                </span>

                                <?php echo date('d M Y', strtotime($event['event_date'])); ?>
                            </div>

                        </div>

                        <div class="card-footer">

                            <div>

                                <small>Mulai dari</small>

                                <h4>
                                    Rp <?php echo number_format($event['regular_price']); ?>
                                </h4>

                            </div>

                            <a
                                href="detail_event.php?id=<?php echo $event['id']; ?>"
                                class="btn-detail"
                            >
                                Detail
                            </a>

                        </div>

                    </div>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="empty-state">

                <span class="material-symbols-outlined">
                    event_busy
                </span>

                <h3>Belum Ada Event</h3>

                <p>
                    Event yang ditambahkan admin akan muncul di sini.
                </p>

            </div>

        <?php endif; ?>

    </section>

    <div class="pagination">

        <button>
            <span class="material-symbols-outlined">
                chevron_left
            </span>
        </button>

        <button class="active">
            1
        </button>

        <button>2</button>
        <button>3</button>

        <button>
            <span class="material-symbols-outlined">
                chevron_right
            </span>
        </button>

    </div>

</main>

<?php include '../includes/footer.php'; ?>

<script>
const filters =
document.querySelectorAll('.genre-filter button');

filters.forEach(btn => {

    btn.addEventListener('click', () => {

        filters.forEach(b =>
            b.classList.remove('active')
        );

        btn.classList.add('active');

    });

});
</script>

</body>
</html>