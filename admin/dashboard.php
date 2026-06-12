<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>

<h1>Dashboard Admin</h1>

<p>
    Selamat datang,
    <b><?= $_SESSION['admin_username']; ?></b>
</p>

<a href="logout.php">Logout</a>

</body>
</html>