<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$adminName = $_SESSION['admin_username'];
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

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="sidebar-header">
            <h1>TiketKonser</h1>
            <p>ADMIN DASHBOARD</p>
        </div>

        <nav class="sidebar-menu">

            <a href="dashboard.php" class="menu-item active">
                <i class="fas fa-chart-line"></i>
                Dashboard
            </a>

            <a href="events.php" class="menu-item">
                <i class="fas fa-calendar-alt"></i>
                Manajemen Event
            </a>

            <a href="orders.php" class="menu-item">
                <i class="fas fa-receipt"></i>
                Manajemen Pesanan
            </a>

            <a href="tickets.php" class="menu-item">
                <i class="fas fa-ticket-alt"></i>
                Distribusi Tiket
            </a>

        </nav>

        <div class="sidebar-footer">

            <div class="admin-avatar">
                <?= strtoupper(substr($adminName, 0, 1)); ?>
            </div>

            <div class="admin-info">
                <h4><?= htmlspecialchars($adminName); ?></h4>
                <p>Super Admin</p>
            </div>

        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="search-box">

                <i class="fas fa-search"></i>

                <input
                    type="text"
                    placeholder="Cari event, pesanan, atau tiket...">

            </div>

            <div class="topbar-right">

                <button class="notification-btn">
                    <i class="fas fa-bell"></i>

                    <span class="notif-dot"></span>
                </button>

                <div class="profile-box">

                    <div>
                        <span class="profile-label">
                            Admin Profile
                        </span>
                    </div>

                    <div class="profile-avatar">
                        <?= strtoupper(substr($adminName, 0, 1)); ?>
                    </div>

                </div>

            </div>

        </header>

        <!-- CONTENT -->
        <section class="content">

            <div class="page-header">

                <h2>Ringkasan Performa</h2>

                <p>
                    Data terbaru performa penjualan tiket hari ini.
                </p>

            </div>

            <!-- KPI CARD -->
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
                    124
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
                    2.840
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
                    15.2K
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
                    Rp4.2M
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
                    42
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

                    <div class="bar-group">
                        <div class="bar" style="height:80px;"></div>
                        <span>Sen</span>
                    </div>

                    <div class="bar-group">
                        <div class="bar" style="height:140px;"></div>
                        <span>Sel</span>
                    </div>

                    <div class="bar-group">
                        <div class="bar" style="height:110px;"></div>
                        <span>Rab</span>
                    </div>

                    <div class="bar-group">
                        <div class="bar" style="height:170px;"></div>
                        <span>Kam</span>
                    </div>

                    <div class="bar-group">
                        <div class="bar" style="height:200px;"></div>
                        <span>Jum</span>
                    </div>

                    <div class="bar-group">
                        <div class="bar" style="height:150px;"></div>
                        <span>Sab</span>
                    </div>

                    <div class="bar-group">
                        <div class="bar" style="height:120px;"></div>
                        <span>Min</span>
                    </div>

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

                <div class="event-item">

                    <img src="https://picsum.photos/80?random=1" alt="">

                    <div class="event-info">

                        <h4>Neon Night Festival</h4>

                        <span>4.2K tiket terjual</span>

                    </div>

                    <strong>98%</strong>

                </div>

                <div class="event-item">

                    <img src="https://picsum.photos/80?random=2" alt="">

                    <div class="event-info">

                        <h4>Jakarta Tech Summit</h4>

                        <span>2.1K tiket terjual</span>

                    </div>

                    <strong>85%</strong>

                </div>

                <div class="event-item">

                    <img src="https://picsum.photos/80?random=3" alt="">

                    <div class="event-info">

                        <h4>Symphony In The Park</h4>

                        <span>1.8K tiket terjual</span>

                    </div>

                    <strong>72%</strong>

                </div>

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

                        <tr>

                            <td>#TK-88210</td>
                            <td>Andri Permana</td>
                            <td>Neon Night Festival</td>
                            <td>12 Mei, 14:20</td>
                            <td>Rp1.500.000</td>

                            <td>
                                <span class="status success">
                                    BERHASIL
                                </span>
                            </td>

                            <td>

                                <button class="action-btn">

                                    <i class="fas fa-ellipsis-h"></i>

                                </button>

                            </td>

                        </tr>

                        <tr>

                            <td>#TK-88209</td>
                            <td>Siti Aminah</td>
                            <td>Jakarta Tech Summit</td>
                            <td>12 Mei, 13:45</td>
                            <td>Rp450.000</td>

                            <td>
                                <span class="status warning">
                                    PENDING
                                </span>
                            </td>

                            <td>

                                <button class="action-btn">

                                    <i class="fas fa-ellipsis-h"></i>

                                </button>

                            </td>

                        </tr>

                        <tr>

                            <td>#TK-88208</td>
                            <td>Budi Santoso</td>
                            <td>Neon Night Festival</td>
                            <td>12 Mei, 12:10</td>
                            <td>Rp750.000</td>

                            <td>
                                <span class="status success">
                                    BERHASIL
                                </span>
                            </td>

                            <td>

                                <button class="action-btn">

                                    <i class="fas fa-ellipsis-h"></i>

                                </button>

                            </td>

                        </tr>

                        <tr>

                            <td>#TK-88207</td>
                            <td>Dewi Lestari</td>
                            <td>Symphony In The Park</td>
                            <td>12 Mei, 11:30</td>
                            <td>Rp1.200.000</td>

                            <td>
                                <span class="status danger">
                                    GAGAL
                                </span>
                            </td>

                            <td>

                                <button class="action-btn">

                                    <i class="fas fa-ellipsis-h"></i>

                                </button>

                            </td>

                        </tr>

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