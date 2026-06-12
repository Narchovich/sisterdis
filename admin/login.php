<?php
session_start();
require_once '../config/database.php';

// Jika sudah login, langsung ke dashboard
// if (isset($_SESSION['admin_id'])) {
//     header("Location: dashboard.php");
//     exit;
// }

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query(
        $conn,
        "SELECT * FROM admin 
         WHERE username='$username'
         AND password='$password'
         LIMIT 1"
    );

    if (mysqli_num_rows($query) > 0) {

        $admin = mysqli_fetch_assoc($query);

        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];

        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - TiketKonser</title>

    <link rel="stylesheet" href="../assets/css/admin-login.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<div class="login-container">

    <div class="login-card">

        <!-- Logo -->
        <div class="logo-box">
            <i class="fa-solid fa-ticket"></i>
        </div>

        <h1>TiketKonser</h1>

        <p class="subtitle">
            Selamat datang kembali, Admin.
        </p>

        <?php if ($error != "") : ?>
            <div class="alert-error">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <!-- Username -->
            <label>Username</label>

            <div class="input-group">

                <i class="fa-regular fa-user"></i>

                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan username Anda"
                    required>

            </div>

            <!-- Password -->
            <div class="password-header">

                <label>Password</label>

                <a href="#">
                    Lupa sandi?
                </a>

            </div>

            <div class="input-group">

                <i class="fa-solid fa-lock"></i>

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Masukkan password"
                    required>

                <button
                    type="button"
                    class="toggle-password"
                    onclick="togglePassword()">

                </button>

            </div>

            <!-- Remember -->
            <div class="remember">

                <input
                    type="checkbox"
                    id="remember">

                <label for="remember">
                    Ingat saya untuk 30 hari
                </label>

            </div>

            <!-- Login -->
            <button
                type="submit"
                class="login-btn">

                Masuk ke Dashboard

                <i class="fa-solid fa-arrow-right"></i>

            </button>

        </form>

        <div class="login-footer">

            © 2024 TiketKonser Admin Panel.<br>
            Versi 2.4.1 (Stable Build)

        </div>

    </div>

</div>

<script src="../assets/js/admin-login.js"></script>

</body>
</html>