<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once '../config/database.php';

$adminName = $_SESSION['admin_username'];

/* KPI */

// Total Event
$qEvent = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM events"
);
$totalEvent = mysqli_fetch_assoc($qEvent)['total'];

// Total Pesanan
$qOrder = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM orders"
);
$totalOrder = mysqli_fetch_assoc($qOrder)['total'];

// Tiket Terjual
$qTicket = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM tickets"
);
$totalTicket = mysqli_fetch_assoc($qTicket)['total'];

// Pendapatan
$qRevenue = mysqli_query(
    $conn,
    "SELECT SUM(grand_total) AS total
     FROM orders
     WHERE status='Approved'"
);

$totalRevenue =
    mysqli_fetch_assoc($qRevenue)['total'] ?? 0;

// Pending
$qPending = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM orders
     WHERE status='Pending'"
);

$totalPending =
    mysqli_fetch_assoc($qPending)['total'];


$salesQuery = mysqli_query(
    $conn,
    "SELECT DATE(created_at) AS tanggal,
            COUNT(*) AS jumlah
     FROM orders
     GROUP BY DATE(created_at)
     ORDER BY tanggal DESC
     LIMIT 7"
);

$sales = [];

while ($row = mysqli_fetch_assoc($salesQuery)) {
    $sales[] = $row;
}

$sales = array_reverse($sales);

/* Event Terlaris */

$topEvent = mysqli_query(
    $conn,
    "SELECT
        e.id,
        e.event_name,
        e.poster,
        COUNT(t.id) AS sold
     FROM events e
     LEFT JOIN tickets t
        ON e.id = t.event_id
     GROUP BY e.id
     ORDER BY sold DESC
     LIMIT 3"
);
/* Pesanan Terbaru */

$latestOrder = mysqli_query(
    $conn,
    "SELECT
        o.id,
        o.invoice_number,
        o.sender_name,
        e.event_name,
        o.created_at,
        o.grand_total,
        o.status
     FROM orders o
     LEFT JOIN events e
        ON o.event_id = e.id
     ORDER BY o.created_at DESC
     LIMIT 5"
);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - TiketKonser</title>

    <link rel="stylesheet" href="../assets/css/admin-dashboard.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <div class="dashboard-container">

        <?php include '../includes/admin-sidebar.php'; ?>

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- TOPBAR -->
            <?php include '../includes/admin-topbar.php'; ?>
            <!-- CONTENT -->
            <section class="content">

                <div class="page-header">

                    <h2>Ringkasan Performa</h2>

                    <p>
                        Data terbaru performa penjualan tiket hari ini.
                    </p>

                </div>

                <div class="stats-grid">

                    <!-- Total Event -->
                    <div class="stat-card">

                        <div class="stat-header">

                            <i class="fas fa-calendar-alt stat-icon"></i>

                            <span class="stat-badge success">
                                <i class="fas fa-arrow-up"></i>
                                12%
                            </span>

                        </div>

                        <span class="stat-title">
                            Total Event
                        </span>

                        <h3 class="stat-value">
                            <?= $totalEvent ?>
                        </h3>

                    </div>

                    <!-- Total Pesanan -->
                    <div class="stat-card">

                        <div class="stat-header">

                            <i class="fas fa-shopping-cart stat-icon"></i>

                            <span class="stat-badge success">
                                <i class="fas fa-arrow-up"></i>
                                8%
                            </span>

                        </div>

                        <span class="stat-title">
                            Total Pesanan
                        </span>

                        <h3 class="stat-value">
                            <?= $totalOrder ?>
                        </h3>

                    </div>

                    <!-- Tiket Terjual -->
                    <div class="stat-card">

                        <div class="stat-header">

                            <i class="fas fa-ticket-alt stat-icon"></i>

                            <span class="stat-badge success">
                                <i class="fas fa-arrow-up"></i>
                                15%
                            </span>

                        </div>

                        <span class="stat-title">
                            Tiket Terjual
                        </span>

                        <h3 class="stat-value">
                            <?= $totalTicket ?>
                        </h3>

                    </div>

                    <!-- Pendapatan -->
                    <div class="stat-card">

                        <div class="stat-header">

                            <i class="fas fa-wallet stat-icon"></i>

                            <span class="stat-badge success">
                                <i class="fas fa-arrow-up"></i>
                                21%
                            </span>

                        </div>

                        <span class="stat-title">
                            Pendapatan
                        </span>

                        <h3 class="stat-value">
                            Rp<?= number_format($totalRevenue, 0, ',', '.') ?>
                        </h3>

                    </div>

                    <!-- Pending -->
                    <div class="stat-card">

                        <div class="stat-header">

                            <i class="fas fa-clock stat-icon"></i>

                            <span class="stat-badge danger">
                                <i class="fas fa-arrow-down"></i>
                                5%
                            </span>

                        </div>

                        <span class="stat-title">
                            Pending
                        </span>

                        <h3 class="stat-value">
                            <?= $totalPending ?>
                        </h3>

                    </div>

                </div>

                <!-- Grafik + Event Terlaris -->
                <div class="dashboard-row">

                    <!-- Grafik Penjualan -->
                    <div class="sales-chart">

                        <div class="card-header">

                            <div>

                                <h3>Grafik Penjualan</h3>

                                <p>
                                    Estimasi volume penjualan 7 hari terakhir
                                </p>

                            </div>

                            <div class="chart-filter">

                                <button class="active">
                                    Mingguan
                                </button>

                                <button>
                                    Bulanan
                                </button>

                            </div>

                        </div>

                        <div class="chart-bars">

                            <?php if (count($sales) > 0): ?>

                                <?php foreach ($sales as $item): ?>

                                    <div class="bar-group">

                                        <div class="bar"
                                            style="height: <?= max($item['jumlah'] * 20, 20) ?>px;">
                                        </div>

                                        <span>
                                            <?= date('D', strtotime($item['tanggal'])) ?>
                                        </span>

                                    </div>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <p>Belum ada data penjualan.</p>

                            <?php endif; ?>

                        </div>

                    </div>

                    <!-- Event Terlaris -->
                    <div class="top-events">

                        <div class="card-header">

                            <h3>Event Terlaris</h3>

                            <a href="#">
                                Lihat Semua
                            </a>

                        </div>

                        <?php while ($event = mysqli_fetch_assoc($topEvent)): ?>

                            <div class="event-item">

                                <img
                                    src="../assets/images/<?= !empty($event['poster']) ? $event['poster'] : 'default-event.jpg' ?>"
                                    alt="<?= htmlspecialchars($event['event_name']) ?>">

                                <div class="event-info">

                                    <h4>
                                        <?= htmlspecialchars($event['event_name']) ?>
                                    </h4>

                                    <span>
                                        <?= $event['sold'] ?> tiket terjual
                                    </span>

                                </div>

                                <strong>
                                    <?= $event['sold'] ?>
                                </strong>

                            </div>

                        <?php endwhile; ?>

                    </div>

                </div>
                <!-- Pesanan Terbaru -->
                <div class="orders-card">

                    <div class="card-header">

                        <h3>Pesanan Terbaru</h3>

                        <button class="filter-btn">

                            <i class="fas fa-filter"></i>

                            Filter

                        </button>

                    </div>

                    <div class="table-responsive">

                        <table>

                            <thead>

                                <tr>

                                    <th>ID</th>
                                    <th>Pembeli</th>
                                    <th>Event</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if (mysqli_num_rows($latestOrder) > 0): ?>

                                    <?php while ($row = mysqli_fetch_assoc($latestOrder)): ?>

                                        <tr>

                                            <td>
                                                <?= htmlspecialchars(
                                                    $row['invoice_number']
                                                ) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars(
                                                    $row['sender_name']
                                                ) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars(
                                                    $row['event_name']
                                                ) ?>
                                            </td>

                                            <td>
                                                <?= date(
                                                    'd M Y H:i',
                                                    strtotime($row['created_at'])
                                                ) ?>
                                            </td>

                                            <td>
                                                Rp<?= number_format(
                                                        $row['grand_total'],
                                                        0,
                                                        ',',
                                                        '.'
                                                    ) ?>
                                            </td>

                                            <td>

                                                <?php
                                                $status = strtolower($row['status']);

                                                if ($status == 'approved') {
                                                    $badge = 'success';
                                                } elseif ($status == 'pending') {
                                                    $badge = 'warning';
                                                } else {
                                                    $badge = 'danger';
                                                }
                                                ?>

                                                <span class="status <?= $badge ?>">

                                                    <?= strtoupper(
                                                        $row['status']
                                                    ) ?>

                                                </span>

                                            </td>

                                            <td>

                                                <button class="action-btn">

                                                    <i class="fas fa-ellipsis-h"></i>

                                                </button>

                                            </td>

                                        </tr>

                                    <?php endwhile; ?>

                                <?php else: ?>

                                    <tr>

                                        <td colspan="7"
                                            style="
                                            text-align:center;
                                            padding:30px;
                                        ">
                                            Belum ada pesanan.
                                        </td>

                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                    <!-- Pagination -->
                    <div class="pagination">

                        <span>
                            Menampilkan 4 dari 2.840 data
                        </span>

                        <div class="pagination-buttons">

                            <button>
                                <i class="fas fa-chevron-left"></i>
                            </button>

                            <button class="active">
                                1
                            </button>

                            <button>
                                2
                            </button>

                            <button>
                                3
                            </button>

                            <button>
                                <i class="fas fa-chevron-right"></i>
                            </button>

                        </div>

                    </div>

                </div>

            </section>

        </main>

    </div>

</body>

</html>