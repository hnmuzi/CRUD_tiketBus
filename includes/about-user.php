<?php
session_start();

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - PO BUS JAYA BAKTI</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/user.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<header class="header-riwayat">
    <div class="logo-riwayat">
        🚍 <span>PO BUS JAYA BAKTI</span>
    </div>
    <nav class="nav-riwayat">
        <ul>
            <li><a href="halaman_user.php">Beranda</a></li>
            <li><a href="form_pemesanan.php">Pesan Tiket</a></li>
            <li><a href="riwayat.php">Riwayat Saya</a></li>
            <li><a href="about-user.php" class="active">About</a></li>
            <li><a href="keluar.php" class="logout-riwayat">Logout</a></li>
        </ul>
    </nav>
</header>

<body class="body-admin">

    <!-- Main Content -->
    <main class="main-about">
        <div class="card-about">
            <h2>Tentang Bus di Indonesia</h2>
            <p>
                Transportasi bus di Indonesia telah lama menjadi moda transportasi darat favorit masyarakat. Dengan
                trayek yang menjangkau berbagai daerah, bus mempermudah mobilitas dari kota ke kota dan antar provinsi.
                Operator bus juga terus meningkatkan kualitas pelayanan dengan menghadirkan berbagai kelas layanan,
                mulai dari ekonomi hingga eksekutif.
            </p>
            <p>
                PO BUS JAYA BAKTI berkomitmen menghadirkan pengalaman perjalanan yang aman, nyaman, dan tepat waktu.
                Didukung sistem digital terkini dan armada yang terawat, kami siap menjadi pilihan terpercaya bagi
                penumpang untuk menjelajahi berbagai destinasi di Indonesia.
            </p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-admin">
        <p>&copy; <?php echo date("Y"); ?> PO BUS JAYA BAKTI. All rights reserved.</p>
    </footer>

</body>

</html>