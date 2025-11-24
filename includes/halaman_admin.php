<?php
session_start();
include 'koneksi.php';

// Cek login & level
if (!isset($_SESSION['username']) || $_SESSION['level'] != "admin") {
    header("Location: index.php");
    exit;
}

// Total Pemesanan
$q_pemesanan = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pobus_tiket");
$total_pemesanan = mysqli_fetch_assoc($q_pemesanan)['total'];

// Total User
$q_user = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM user");
$total_user = mysqli_fetch_assoc($q_user)['total'];

// Total Armada Bus
$q_bus = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pobus_bus");
$total_bus = mysqli_fetch_assoc($q_bus)['total'];

// Jadwal Hari Ini (cek di tabel rute sesuai tanggal hari ini)
$tgl_hari_ini = date("Y-m-d");
$q_jadwal = mysqli_query($koneksi, "
    SELECT COUNT(*) AS total 
    FROM pobus_tiket 
    WHERE DATE(tgl_berangkat) = CURDATE()
");
$total_jadwal = mysqli_fetch_assoc($q_jadwal)['total'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PO BUS JAYA BAKTI</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body class="body-admin">

    <!-- Header -->
    <header class="header-admin">
        <h1>🚍 PO BUS JAYA BAKTI</h1>
        <nav class="navbar-admin">
            <ul>
                <li><a href="halaman_admin.php">Dashboard</a></li>
                <li><a href="armada-bus.php">Data Armada Bus</a></li>
                <li><a href="tabel_pemesanan.php">Data Pemesanan</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="keluar.php" class="logout-btn-admin">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main -->
    <main class="main-admin">
        <div class="card-admin">
            <h2>Dashboard Admin</h2>
            <p>Selamat datang di sistem manajemen pemesanan tiket bus <b>Jaya Bakti</b>.
                Gunakan menu navigasi atau pilih menu cepat di bawah untuk mengelola data.</p>
            <!-- Ringkasan Data -->
            <section class="dashboard-stats-admin">
                <div class="stat-card-admin">
                    <h3>📋 Total Pemesanan</h3>
                    <p><?= $total_pemesanan; ?></p>
                </div>
                <div class="stat-card-admin">
                    <h3>👥 Total User</h3>
                    <p><?= $total_user; ?></p>
                </div>
                <div class="stat-card-admin">
                    <h3>🚌 Armada Bus</h3>
                    <p><?= $total_bus; ?></p>
                </div>
                <div class="stat-card-admin-jadwal">
                    <h3>📅 Jadwal Hari Ini</h3>
                    <p><?= $total_jadwal; ?> Rute</p>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-admin">
        <p>&copy; <?= date("Y"); ?> PO BUS JAYA BAKTI. All rights reserved.</p>
    </footer>

</body>

</html>