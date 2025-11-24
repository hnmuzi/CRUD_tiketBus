<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username']) || $_SESSION['level'] != "user") {
  header("location:index.php");
  exit;
}

require("koneksi.php");
$user_id = $_SESSION['id'];

// Hitung jumlah tiket user
$total = $aktif = $selesai = 0;
$sql = "SELECT COUNT(*) as jml, 
               SUM(CASE WHEN tgl_berangkat >= CURDATE() THEN 1 ELSE 0 END) as aktif,
               SUM(CASE WHEN tgl_berangkat < CURDATE() THEN 1 ELSE 0 END) as selesai
        FROM pobus_tiket WHERE user_id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result()->fetch_assoc();

$total   = $res['jml'];
$aktif   = $res['aktif'];
$selesai = $res['selesai'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - PO BUS JAYA BAKTI</title>
    <link rel="stylesheet" href="../assets/css/user.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body class="body-h-user">

    <!-- Header -->
    <header class="header-h-user">
        <div class="logo-h-user">
            🚍 <span>PO BUS JAYA BAKTI</span>
        </div>
        <nav class="nav-h-user">
            <ul>
                <li><a href="#" class="active">Beranda</a></li>
                <li><a href="form_pemesanan.php">Pesan Tiket</a></li>
                <li><a href="riwayat.php">Riwayat Saya</a></li>
                <li><a href="about-user.php">About</a></li>
                <li><a href="keluar.php" class="logout-h-user">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main -->
    <main class="main-h-user">
        <section class="card-h-user">
            <h2>Selamat Datang 👋</h2>
            <p>Halo, <b><?= $_SESSION['username']; ?></b>!<br>
                Anda login sebagai <b>User</b>.
                Gunakan menu di atas untuk memesan tiket, melihat riwayat, atau info lainnya.</p>
        </section>

        <!-- Ringkasan Tiket -->
        <section class="summary-h-user">
            <div class="summary-card total">
                <h3>Total Pemesanan</h3>
                <p><?= $total; ?> Tiket</p>
            </div>
            <div class="summary-card aktif">
                <h3>Tiket Aktif</h3>
                <p><?= $aktif; ?> Tiket</p>
            </div>
            <div class="summary-card selesai">
                <h3>Tiket Selesai</h3>
                <p><?= $selesai; ?> Tiket</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer-h-user">
        <p>&copy; <?= date("Y"); ?> PO BUS JAYA BAKTI. All rights reserved.</p>
    </footer>

</body>

</html>