<?php
require '../config/database.php';

/** @var mysqli $conn */
$conn = $conn;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $event_date = $_POST['event_date'];
    $promoter = mysqli_real_escape_string($conn, $_POST['promoter']);
    $status = $_POST['status'];

    $vip_price = $_POST['vip_price'];
    $vip_quota = $_POST['vip_quota'];

    $regular_price = $_POST['regular_price'];
    $regular_quota = $_POST['regular_quota'];

    $vip_remaining = $vip_quota;
    $regular_remaining = $regular_quota;

    // Upload Folder
    $posterDir = "../uploads/posters/";
    $bannerDir = "../uploads/banner/";
    $mapDir    = "../uploads/maps/";

    $posterName = null;
    $bannerName = null;
    $mapName = null;

    // POSTER
    if (!empty($_FILES['poster']['name'])) {

        $posterName = time() . "_poster_" . basename($_FILES['poster']['name']);

        move_uploaded_file(
            $_FILES['poster']['tmp_name'],
            $posterDir . $posterName
        );
    }

    // BANNER
    if (!empty($_FILES['banner']['name'])) {

        $bannerName = time() . "_banner_" . basename($_FILES['banner']['name']);

        move_uploaded_file(
            $_FILES['banner']['tmp_name'],
            $bannerDir . $bannerName
        );
    }

    // MAP
    if (!empty($_FILES['venue_map']['name'])) {

        $mapName = time() . "_map_" . basename($_FILES['venue_map']['name']);

        move_uploaded_file(
            $_FILES['venue_map']['tmp_name'],
            $mapDir . $mapName
        );
    }

    $query = mysqli_query($conn, "
        INSERT INTO events (
            event_name,
            poster,
            banner,
            description,
            location,
            event_date,
            promoter,
            venue_map,
            vip_price,
            vip_quota,
            vip_remaining,
            regular_price,
            regular_quota,
            regular_remaining,
            status
        )
        VALUES (
            '$event_name',
            '$posterName',
            '$bannerName',
            '$description',
            '$location',
            '$event_date',
            '$promoter',
            '$mapName',
            '$vip_price',
            '$vip_quota',
            '$vip_remaining',
            '$regular_price',
            '$regular_quota',
            '$regular_remaining',
            '$status'
        )
    ");

    if ($query) {
        header("Location: manajemen_event.php?success=1");
        exit;
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Event</title>

    <link rel="stylesheet" href="../assets/css/admin-dashboard.css">
    <link rel="stylesheet" href="../assets/css/tambah_event.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <div class="dashboard-container">

        <?php include '../includes/admin-sidebar.php'; ?>

        <div class="main-content">

            <?php include '../includes/admin-topbar.php'; ?>

            <div class="content">

                <div class="breadcrumb">
                    <a href="dashboard.php">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="manajemen_event.php">Manajemen Event</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Tambah Event</span>
                </div>

                <div class="page-title">
                    <h2>Tambah Event Baru</h2>
                    <p>Isi informasi lengkap event sebelum dipublikasikan.</p>
                </div>

                <?php if (isset($_GET['success'])): ?>

                    <div class="alert-success">
                        Event berhasil ditambahkan.
                    </div>
                <?php endif; ?>

                <form method="POST"
                    enctype="multipart/form-data">

                    <div class="event-form">

                        <div class="form-left">

                            <div class="form-card">

                                <h3>
                                    <i class="fa-solid fa-circle-info"></i>
                                    Informasi Umum
                                </h3>

                                <div class="row-2">

                                    <div class="form-group">
                                        <label>ID Event (Otomatis)</label>

                                        <input
                                            type="text"
                                            value="TK-EVENT-AUTO"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Event</label>

                                        <input
                                            type="text"
                                            name="event_name"
                                            placeholder="Contoh: Konser Senja Bahagia"
                                            required>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Deskripsi Event *</label>

                                    <textarea
                                        name="description"
                                        placeholder="Jelaskan detail event, line-up artis, dan informasi penting lainnya..."
                                        required></textarea>

                                </div>

                                <div class="row-2">

                                    <div class="form-group">
                                        <label>Tanggal Pelaksanaan *</label>

                                        <input
                                            type="date"
                                            name="event_date"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label>Status Publikasi</label>

                                        <select name="status">
                                            <option value="Draft">Draft</option>
                                            <option value="Upcoming">Upcoming</option>
                                            <option value="Active">Active</option>
                                            <option value="Finished">Finished</option>
                                        </select>
                                    </div>

                                </div>

                            </div>

                            <div class="form-card">

                                <h3>
                                    <i class="fa-solid fa-ticket"></i>
                                    Harga & Inventaris Tiket
                                </h3>

                                <div class="row-2">

                                    <div class="ticket-box vip">

                                        <div class="ticket-header">

                                            <h4>Kategori VIP</h4>

                                            <span class="badge premium">
                                                PREMIUM
                                            </span>

                                        </div>

                                        <div class="form-group">

                                            <label>Harga Tiket (Rp)</label>

                                            <input
                                                type="number"
                                                name="vip_price"
                                                required>

                                        </div>

                                        <div class="row-2">

                                            <div class="form-group">
                                                <label>Kuota</label>

                                                <input
                                                    type="number"
                                                    name="vip_quota"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label>Tersisa</label>

                                                <input
                                                    type="text"
                                                    value="Auto"
                                                    readonly>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="ticket-box regular">

                                        <div class="ticket-header">

                                            <h4>Kategori Regular</h4>

                                            <span class="badge standard">
                                                STANDARD
                                            </span>

                                        </div>

                                        <div class="form-group">

                                            <label>Harga Tiket (Rp)</label>

                                            <input
                                                type="number"
                                                name="regular_price"
                                                required>

                                        </div>

                                        <div class="row-2">

                                            <div class="form-group">
                                                <label>Kuota</label>

                                                <input
                                                    type="number"
                                                    name="regular_quota"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label>Tersisa</label>

                                                <input
                                                    type="text"
                                                    value="Auto"
                                                    readonly>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="form-right">

                            <div class="form-card">

                                <h3>
                                    <i class="fa-solid fa-image"></i>
                                    Media Visual
                                </h3>

                                <div class="form-group">

                                    <label>Poster Event (Portrait)</label>

                                    <div class="upload-box poster-box">

                                        <i class="fas fa-image"></i>

                                        <p>Upload Poster (2:3)</p>

                                        <small>Maks 5MB JPG PNG</small>

                                        <input type="file" name="poster">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Banner Header (Landscape)</label>

                                    <div class="upload-box banner-box">

                                        <i class="fas fa-cloud-upload-alt"></i>

                                        <p>Upload Banner (21:9)</p>

                                        <input type="file" name="banner">

                                    </div>

                                </div>

                            </div>

                            <div class="form-card">

                                <h3>
                                    <i class="fa-solid fa-location-dot"></i>
                                    Lokasi & Venue
                                </h3>

                                <div class="form-group">
                                    <label>Venue</label>

                                    <input type="text"
                                        name="location"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Promoter</label>

                                    <input type="text"
                                        name="promoter">
                                </div>

                                <div class="form-group">

                                    <label>Denah Venue (Map)</label>

                                    <div class="upload-box small-upload">

                                        <i class="fa-solid fa-map-location-dot"></i>

                                        <p>Upload Venue Map</p>

                                        <input
                                            type="file"
                                            name="venue_map">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="form-actions">
                        
                        <a href="manajemen_event.php"
                            class="btn-secondary">
                            Kembali
                        </a>

                        <button type="submit"
                            class="btn-primary">
                            Simpan Event
                        </button>

                    </div>

                </form>


            </div>

        </div>

    </div>

</body>

</html>