<?php
include '../config/database.php';

$limit = 3;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1){
    $page = 1;
}

/* Statistik */

$totalEvent = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT COUNT(*) total FROM events")
)['total'];

$totalAktif = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT COUNT(*) total
     FROM events
     WHERE status='Aktif'")
)['total'];

/* Nanti bisa diganti tabel transaksi */
$totalTiket = 1200;
$totalPendapatan = 420000000;

/* Pagination */

$totalRows = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT COUNT(*) total FROM events")
)['total'];

$totalPages = max(1, ceil($totalRows / $limit));

if($page > $totalPages){
    $page = 1;
}

$offset = ($page - 1) * $limit;

$events = mysqli_query($conn,"
SELECT *
FROM events
ORDER BY event_date ASC
LIMIT $limit OFFSET $offset
");
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manajemen Event</title>

<link rel="stylesheet" href="../assets/css/admin-dashboard.css">
<link rel="stylesheet" href="../assets/css/manajemen_event.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

</head>

<body>

<div class="dashboard-container">

    <?php include '../includes/admin-sidebar.php'; ?>

    <main class="main-content">

        <?php include '../includes/admin-topbar.php'; ?>

        <div class="content">

            <div class="page-heading">

                <div>

                    <h2>Manajemen Event</h2>

                    <p>
                        Kelola dan pantau semua konser musik
                        dari satu dashboard terpusat.
                    </p>

                </div>

                <a href="tambah_event.php" class="btn-add">

                    <span class="material-symbols-outlined">
                        add
                    </span>

                    Tambah Event Baru

                </a>

            </div>

            <div class="stats-grid">

                <div class="stat-card">

                    <span>TOTAL EVENT</span>

                    <div class="stat-row">

                        <h2><?= $totalEvent ?></h2>

                        <small class="green">
                            ↗ +12%
                        </small>

                    </div>

                </div>

                <div class="stat-card">

                    <span>EVENT AKTIF</span>

                    <div class="stat-row">

                        <h2><?= $totalAktif ?></h2>

                        <small class="purple">
                            Live Now
                        </small>

                    </div>

                </div>

                <div class="stat-card">

                    <span>TIKET TERJUAL</span>

                    <div class="stat-row">

                        <h2>1.2k</h2>

                        <small>
                            Target : 2k
                        </small>

                    </div>

                </div>

                <div class="stat-card">

                    <span>TOTAL PENDAPATAN</span>

                    <div class="stat-row">

                        <h2>
                            Rp <?= number_format($totalPendapatan/1000000) ?>M
                        </h2>

                        <small class="pink">
                            Monthly
                        </small>

                    </div>

                </div>

            </div>

            <div class="table-card">

                <div class="table-top">

                    <h2>Daftar Event Terkini</h2>

                    <div class="filters">

                        <button>Semua</button>
                        <button>Aktif</button>
                        <button>Selesai</button>

                    </div>

                </div>

                <table>

                    <thead>

                        <tr>

                            <th>POSTER</th>
                            <th>NAMA EVENT</th>
                            <th>TANGGAL</th>
                            <th>LOKASI</th>
                            <th>STATUS</th>
                            <th>AKSI</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while($event = mysqli_fetch_assoc($events)): ?>

                        <tr>

                            <td>

                                <img
                                    src="../assets/images/<?= $event['poster']; ?>"
                                    class="poster"
                                >

                            </td>

                            <td>

                                <strong>
                                    <?= $event['event_name']; ?>
                                </strong>

                                <br>

                                <small>
                                    ID:
                                    EVT-<?= str_pad($event['id'],4,'0',STR_PAD_LEFT); ?>
                                </small>

                            </td>

                            <td>
                                <?= date('d M Y',strtotime($event['event_date'])) ?>
                            </td>

                            <td>
                                <?= $event['location']; ?>
                            </td>

                            <td>

                                <span class="status <?= strtolower($event['status']); ?>">
                                    <?= $event['status']; ?>
                                </span>

                            </td>

                            <td>

                                <a
                                    href="edit_event.php?id=<?= $event['id']; ?>"
                                    class="action-btn edit"
                                >
                                    Edit
                                </a>

                                <a
                                    href="hapus_event.php?id=<?= $event['id']; ?>"
                                    class="action-btn delete"
                                    onclick="return confirm('Hapus event ini?')"
                                >
                                    Hapus
                                </a>

                            </td>

                        </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

                <div class="table-footer">

                    <span>

                        Menampilkan
                        <?= $offset + 1; ?>

                        -

                        <?= min($offset+$limit,$totalRows); ?>

                        dari

                        <?= $totalRows; ?>

                        event

                    </span>

                    <div class="pagination">

                        <?php if($page > 1): ?>

                            <a href="?page=<?= $page-1 ?>">
                                ‹
                            </a>

                        <?php endif; ?>

                        <?php for($i=1;$i<=$totalPages;$i++): ?>

                            <a
                                href="?page=<?= $i ?>"
                                class="<?= ($i==$page)?'active':'' ?>"
                            >
                                <?= $i ?>
                            </a>

                        <?php endfor; ?>

                        <?php if($page < $totalPages): ?>

                            <a href="?page=<?= $page+1 ?>">
                                ›
                            </a>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>