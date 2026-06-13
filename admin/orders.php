<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once '../config/database.php';

$adminName = $_SESSION['admin_username'];

/* Statistik */

$totalPesanan = mysqli_fetch_assoc(
    mysqli_query($conn, "
        SELECT COUNT(*) AS total
        FROM orders
    ")
);

$totalApproved = mysqli_fetch_assoc(
    mysqli_query($conn, "
        SELECT COUNT(*) AS total
        FROM orders
        WHERE status='Approved'
    ")
);

$totalPending = mysqli_fetch_assoc(
    mysqli_query($conn, "
        SELECT COUNT(*) AS total
        FROM orders
        WHERE status='Pending'
    ")
);

$totalRejected = mysqli_fetch_assoc(
    mysqli_query($conn, "
        SELECT COUNT(*) AS total
        FROM orders
        WHERE status='Rejected'
    ")
);

/* Data Pesanan */

$orders = mysqli_query($conn, "
    SELECT *
    FROM orders
    ORDER BY created_at DESC
");

?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Manajemen Pesanan</title>

    <link rel="stylesheet"
        href="../assets/css/admin-dashboard.css">

    <link rel="stylesheet"
        href="../assets/css/orders.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

    <div class="dashboard-container">

        <?php include '../includes/admin-sidebar.php'; ?>

        <main class="main-content">

            <?php include '../includes/admin-topbar.php'; ?>

            <div class="page-header">

                <div>

                    <h1>Manajemen Pesanan</h1>

                    <p>
                        Kelola seluruh transaksi tiket konser.
                    </p>

                </div>

            </div>
            <!-- Statistik -->
            <div class="order-stats">

                <!-- Total Pesanan -->
                <div class="order-stat-card">

                    <div class="stat-icon blue">

                        <i class="fas fa-shopping-cart"></i>

                    </div>

                    <div>

                        <span class="stat-label">
                            Total Pesanan
                        </span>

                        <h2>
                            <?= $totalPesanan['total']; ?>
                        </h2>

                    </div>

                </div>

                <!-- Approved -->
                <div class="order-stat-card">

                    <div class="stat-icon green">

                        <i class="fas fa-check-circle"></i>

                    </div>

                    <div>

                        <span class="stat-label">
                            Berhasil
                        </span>

                        <h2>
                            <?= $totalApproved['total']; ?>
                        </h2>

                    </div>

                </div>

                <!-- Pending -->
                <div class="order-stat-card">

                    <div class="stat-icon orange">

                        <i class="fas fa-clock"></i>

                    </div>

                    <div>

                        <span class="stat-label">
                            Pending
                        </span>

                        <h2>
                            <?= $totalPending['total']; ?>
                        </h2>

                    </div>

                </div>

                <!-- Rejected -->
                <div class="order-stat-card">

                    <div class="stat-icon red">

                        <i class="fas fa-times-circle"></i>

                    </div>

                    <div>

                        <span class="stat-label">
                            Ditolak
                        </span>

                        <h2>
                            <?= $totalRejected['total']; ?>
                        </h2>

                    </div>

                </div>

            </div>
            <!-- Tabel Pesanan -->
            <div class="orders-card">

                <div class="orders-header">

                    <h2>
                        Daftar Pesanan
                    </h2>

                    <div class="orders-tools">

                        <input
                            type="text"
                            id="searchOrder"
                            placeholder="Cari invoice atau nama...">

                        <select id="filterStatus">

                            <option value="">
                                Semua Status
                            </option>

                            <option value="Pending">
                                Pending
                            </option>

                            <option value="Approved">
                                Approved
                            </option>

                            <option value="Rejected">
                                Rejected
                            </option>

                        </select>

                    </div>

                </div>
                <div class="table-wrapper">

                    <table class="orders-table">

                        <thead>

                            <tr>

                                <th>Invoice</th>

                                <th>Pemesan</th>

                                <th>Total</th>

                                <th>Status</th>

                                <th>Tanggal</th>

                                <th>Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php while ($row = mysqli_fetch_assoc($orders)): ?>

                                <tr>

                                    <td>

                                        <?= $row['invoice_number']; ?>

                                    </td>

                                    <td>

                                        <strong>
                                            <?= htmlspecialchars($row['sender_name']); ?>
                                        </strong>

                                        <br>

                                        <small>
                                            <?= htmlspecialchars($row['email']); ?>
                                        </small>

                                    </td>

                                    <td>

                                        Rp<?= number_format(
                                                $row['grand_total'],
                                                0,
                                                ',',
                                                '.'
                                            ); ?>

                                    </td>

                                    <td>

                                        <?php if ($row['status'] == 'Approved'): ?>

                                            <span class="status approved">

                                                Approved

                                            </span>

                                        <?php elseif ($row['status'] == 'Pending'): ?>

                                            <span class="status pending">

                                                Pending

                                            </span>

                                        <?php else: ?>

                                            <span class="status rejected">

                                                Rejected

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?= date(
                                            'd M Y H:i',
                                            strtotime($row['created_at'])
                                        ); ?>

                                    </td>

                                    <td>

                                        <button
                                            class="detail-btn"

                                            data-id="<?= $row['id']; ?>"

                                            data-invoice="<?= htmlspecialchars($row['invoice_number']); ?>"

                                            data-name="<?= htmlspecialchars($row['sender_name']); ?>"

                                            data-email="<?= htmlspecialchars($row['email']); ?>"

                                            data-bank="<?= htmlspecialchars($row['bank_sender']); ?>"

                                            data-method="<?= htmlspecialchars($row['payment_method']); ?>"

                                            data-total="<?= number_format($row['grand_total'], 0, ',', '.'); ?>"

                                            data-proof="<?= htmlspecialchars($row['payment_proof']); ?>"

                                            data-status="<?= htmlspecialchars($row['status']); ?>">

                                            Detail

                                        </button>

                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        </tbody>

                    </table>

                </div>

            </div>
            <!-- Modal Detail Pesanan -->
            <div class="modal-overlay" id="paymentModal">

                <div class="modal-box">

                    <div class="modal-header">

                        <h2>Detail Pesanan</h2>

                        <button class="close-modal" id="closeModal">

                            <i class="fas fa-times"></i>

                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="detail-group">

                            <label>Invoice</label>

                            <p id="modalInvoice">-</p>

                        </div>

                        <div class="detail-group">

                            <label>Nama Pemesan</label>

                            <p id="modalName">-</p>

                        </div>

                        <div class="detail-group">

                            <label>Email</label>

                            <p id="modalEmail">-</p>

                        </div>

                        <div class="detail-group">

                            <label>Bank Pengirim</label>

                            <p id="modalBank">-</p>

                        </div>

                        <div class="detail-group">

                            <label>Metode Pembayaran</label>

                            <p id="modalMethod">-</p>

                        </div>

                        <div class="detail-group">

                            <label>Total Bayar</label>

                            <p id="modalTotal">-</p>

                        </div>

                        <div class="detail-group">

                            <label>Status</label>

                            <p id="modalStatus">-</p>

                        </div>

                        <div class="detail-group">

                            <label>Bukti Transfer</label>

                            <img
                                id="modalProof"
                                class="proof-image"
                                src=""
                                alt="Bukti Pembayaran">

                        </div>

                    </div>

                    <div class="modal-footer">

                        <a href="#"
                            class="approve-btn"
                            id="approveBtn">

                            Approve

                        </a>

                        <a href="#"
                            class="reject-btn"
                            id="rejectBtn">

                            Reject

                        </a>

                    </div>

                </div>

            </div>
            <script src="../assets/js/orders.js"></script>

</body>

</html>