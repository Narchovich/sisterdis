<?php
include '../config/database.php';

if (!isset($_GET['id'])) {
    die("Event tidak ditemukan");
}

$id = (int)$_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM events WHERE id = $id");
$event = mysqli_fetch_assoc($result);

if (!$event) {
    die("Data event tidak ditemukan");
}

$admin_fee = 5000;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $event['event_name']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/detail_event.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>
<div class="detail-container">
    <div class="event-detail">
        <div class="left-side">
            <img
                src="../assets/images/<?php echo $event['poster']; ?>"
                alt="<?php echo $event['event_name']; ?>"
            >
            <div class="venue-dropdown">
    <button class="dropdown-btn" onclick="toggleVenueMap()">

        <span>
            <i class="bi bi-map"></i>
            Lihat Denah Venue
        </span>
        <i class="bi bi-chevron-down" id="dropdownIcon"></i>
    </button>

    <div class="venue-content" id="venueContent">
        <img
            src="../assets/images/<?php echo $event['venue_map']; ?>"
            alt="Venue Map"
        >
    </div>

</div>
        </div>
        <div class="right-side">
            <div class="tags">
                <span>Live Concert</span>
                <span>Music Event</span>
            </div>

            <h1><?php echo $event['event_name']; ?></h1>

            <p class="description">
                <?php echo nl2br($event['description']); ?>
            </p>

            <div class="info-grid">
                <div class="info-card">
                    <i class="bi bi-calendar-event"></i>
                    <h4>Tanggal</h4>
                    <p>
                        <?php echo date('d F Y', strtotime($event['event_date'])); ?>
                    </p>
                </div>

                <div class="info-card">
                    <i class="bi bi-geo-alt"></i>
                    <h4>Lokasi</h4>
                    <p><?php echo $event['location']; ?></p>
                </div>

                <div class="info-card">
                    <i class="bi bi-building"></i>
                    <h4>Promotor</h4>
                    <p><?php echo $event['promoter']; ?></p>
                </div>

                <div class="info-card">
                    <i class="bi bi-check-circle"></i>
                    <h4>Status</h4>
                    <p><?php echo ucfirst($event['status']); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="section-title">
        <span class="line"></span>
        <h2>Beli Tiket Sekarang</h2>
    </div>

    <div class="ticket-section">
        <div class="ticket-list">
            <h2>Pilih Kategori Tiket</h2>
            <div
                class="ticket-card active"
                data-price="<?php echo $event['vip_price']; ?>"
            >
                <div>
                    <h3>VIP Experience</h3>
                    <p>
                        Akses area terdepan, merchandise eksklusif,
                        dan fasilitas VIP.
                    </p>
                </div>

                <div class="ticket-price">
                    <h2>
                        Rp <?php echo number_format($event['vip_price'],0,',','.'); ?>
                    </h2>
                    <small>
                        Sisa
                        <?php echo $event['vip_remaining']; ?>
                        tiket
                    </small>
                </div>
            </div>

            <div
                class="ticket-card"
                data-price="<?php echo $event['regular_price']; ?>"
            >
                <div>
                    <h3>Regular Festival</h3>
                    <p>
                        Akses area festival reguler
                        dengan view panggung yang nyaman.
                    </p>
                </div>

                <div class="ticket-price">
                    <h2>
                        Rp <?php echo number_format($event['regular_price'],0,',','.'); ?>
                    </h2>
                    <small>
                        Sisa
                        <?php echo $event['regular_remaining']; ?>
                        tiket
                    </small>
                </div>
            </div>

        </div>

        <div class="summary-box">
            <h2>Detail Pemesanan</h2>
            <div class="qty-box">
                <button id="minus">-</button>
                <span id="qty">1</span>
                <button id="plus">+</button>
            </div>

            <div class="summary-row">
                <span>Subtotal Tiket</span>
                <span id="subtotal"></span>
            </div>

            <div class="summary-row">
                <span>Admin Fee</span>
                <span>
                    Rp <?php echo number_format($admin_fee,0,',','.'); ?>
                </span>
            </div>

            <div class="summary-row total">
                <span>Total Bayar</span>
                <span id="total"></span>
            </div>

            <button class="buy-btn">
                Beli Tiket Sekarang
            </button>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
let qty = 1;
let price = <?php echo $event['vip_price']; ?>;
let adminFee = <?php echo $admin_fee; ?>;

const qtyText = document.getElementById('qty');
const subtotalText = document.getElementById('subtotal');
const totalText = document.getElementById('total');

function rupiah(number){
    return 'Rp ' + number.toLocaleString('id-ID');
}

function updateTotal(){

    let subtotal = price * qty;
    let total = subtotal + adminFee;

    subtotalText.innerHTML = rupiah(subtotal);
    totalText.innerHTML = rupiah(total);

}

updateTotal();
document.getElementById('plus').onclick = function(){

    qty++;
    qtyText.innerHTML = qty;

    updateTotal();

}

document.getElementById('minus').onclick = function(){
    if(qty > 1){
        qty--;
        qtyText.innerHTML = qty;
        updateTotal();
    }
}

document.querySelectorAll('.ticket-card').forEach(card => {
    card.addEventListener('click', function(){
        document.querySelectorAll('.ticket-card')
        .forEach(item => item.classList.remove('active'));
        this.classList.add('active');
        price = parseInt(this.dataset.price);
        updateTotal();
    });
});

function toggleVenueMap(){
    const content = document.getElementById('venueContent');
    const icon = document.getElementById('dropdownIcon');
    if(content.style.maxHeight){
        content.style.maxHeight = null;
        icon.classList.remove('bi-chevron-up');
        icon.classList.add('bi-chevron-down');
    }else{
        content.style.maxHeight = content.scrollHeight + "px";
        icon.classList.remove('bi-chevron-down');
        icon.classList.add('bi-chevron-up');
    }
}

</script>

</body>
</html>