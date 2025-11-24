<?php
session_start();
// Cek apakah sudah login
if ($_SESSION['level'] == "") {
    header("location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Armada Bus - PO BUS JAYA BAKTI</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
</head>

<body class="body-admin">
    <!-- HEADER + NAVBAR -->
    <header class="header-admin">
        <h1>🚍 PO BUS JAYA BAKTI</h1>
        <nav class="navbar-admin">
            <ul>
                <li><a href="halaman_admin.php">Dashboard</a></li>
                <li><a href="armada-bus.php" style="background:#ffd700;color:#000;">Data Armada Bus</a></li>
                <li><a href="tabel_pemesanan.php">Data Pemesanan</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="logout.php" class="logout-btn-admin">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <main class="main-armada">
        <!-- NON EKONOMI -->
        <section class="armada-section">
            <div class="card-armada">
                <h2 class="armada-title">Armada Non Ekonomi (8 Unit)</h2>
                <div class="armada-grid">
                    <div class="armada-card">
                        <img src="../assets/img/armada1.jpg" class="armada-image" alt="Bus Rosalia Indah"
                            loading="lazy">
                        <div class="armada-info">
                            <h3>PO Rosalia Indah</h3>
                            <p>Tipe: Super Executive AC</p>
                            <p>Kapasitas: 32 Kursi</p>
                            <p>Trayek: Jakarta - Surabaya</p>
                        </div>
                    </div>
                    <div class="armada-card">
                        <img src="../assets/img/armada2.jpg" class="armada-image" alt="Bus Gunung Harta"
                            loading="lazy">>
                        <div class="armada-info">
                            <h3>PO Gunung Harta</h3>
                            <p>Tipe: Executive AC</p>
                            <p>Kapasitas: 34 Kursi</p>
                            <p>Trayek: Denpasar - Jakarta</p>
                        </div>
                    </div>
                    <div class="armada-card">
                        <img src="../assets/img/armada3.jpg" class="armada-image" alt="Bus Pahala Kencana"
                            loading="lazy">
                        <div class="armada-info">
                            <h3>PO Pahala Kencana</h3>
                            <p>Tipe: Executive AC</p>
                            <p>Kapasitas: 36 Kursi</p>
                            <p>Trayek: Jakarta - Malang</p>
                        </div>
                    </div>
                    <div class="armada-card">
                        <img src="../assets/img/armada4.jpg" class="armada-image" alt="Bus Sinar Jaya" loading="lazy">
                        <div class="armada-info">
                            <h3>PO Sinar Jaya</h3>
                            <p>Tipe: Double Decker Executive AC</p>
                            <p>Kapasitas: 42 Kursi</p>
                            <p>Trayek: Bandung - Semarang</p>
                        </div>
                    </div>
                    <div class="armada-card">
                        <img src="../assets/img/armada5.jpg" class="armada-image" alt="Bus Handoyo" loading="lazy">
                        <div class="armada-info">
                            <h3>PO Handoyo</h3>
                            <p>Tipe: Executive AC</p>
                            <p>Kapasitas: 36 Kursi</p>
                            <p>Trayek: Semarang - Jakarta</p>
                        </div>
                    </div>
                    <div class="armada-card">
                        <img src="../assets/img/armada6.jpg" class="armada-image" alt="Bus Borlindo" loading="lazy">
                        <div class="armada-info">
                            <h3>PO Borlindo</h3>
                            <p>Tipe: Executive AC</p>
                            <p>Kapasitas: 34 Kursi</p>
                            <p>Trayek: Makassar - Palopo</p>
                        </div>
                    </div>
                    <div class="armada-card">
                        <img src="../assets/img/armada7.jpg" class="armada-image" alt="Bus Primajasa" loading="lazy">
                        <div class="armada-info">
                            <h3>PO Primajasa</h3>
                            <p>Tipe: Executive AC</p>
                            <p>Kapasitas: 40 Kursi</p>
                            <p>Trayek: Jakarta - Garut</p>
                        </div>
                    </div>
                    <div class="armada-card">
                        <img src="../assets/img/armada8.jpg" class="armada-image" alt="Bus Bintang Timur"
                            loading="lazy">
                        <div class="armada-info">
                            <h3>PO Bintang Timur</h3>
                            <p>Tipe: Executive AC</p>
                            <p>Kapasitas: 36 Kursi</p>
                            <p>Trayek: Medan - Pekanbaru</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- EKONOMI -->
        <section class="armada-section">
            <div class="card-armada">
                <h2 class="armada-title">Armada Ekonomi (8 Unit)</h2>
                <div class="armada-grid">
                    <div class="armada-card">
                        <img src="../assets/img/armada9.jpg" class="armada-image" alt="Bus Maju Lancar" loading="lazy">
                        <div class="armada-info">
                            <h3>PO Maju Lancar</h3>
                            <p>Tipe: Ekonomi AC</p>
                            <p>Kapasitas: 48 Kursi</p>
                            <p>Trayek: Jakarta - Purwokerto</p>
                        </div>
                    </div>
                    <div class="armada-card">
                        <img src="../assets/img/armada10.jpg" class="armada-image" alt="Bus Rosalia Ekonomi"
                            loading="lazy">
                        <div class="armada-info">
                            <h3>PO Rosalia Indah</h3>
                            <p>Tipe: Ekonomi AC</p>
                            <p>Kapasitas: 50 Kursi</p>
                            <p>Trayek: Solo - Jakarta</p>
                        </div>
                    </div>
                    <div class="armada-card">
                        <img src="../assets/img/armada11.jpg" class="armada-image" alt="Bus Gunung Harta Ekonomi"
                            loading="lazy">
                        <div class="armada-info">
                            <h3>PO Gunung Harta</h3>
                            <p>Tipe: Ekonomi AC</p>
                            <p>Kapasitas: 46 Kursi</p>
                            <p>Trayek: Denpasar - Surabaya</p>
                        </div>
                    </div>
                    <div class="armada-card">
                        <img src="../assets/img/armada12.jpg" class="armada-image" alt="Bus Handoyo Ekonomi"
                            loading="lazy">
                        <div class="armada-info">
                            <h3>PO Handoyo</h3>
                            <p>Tipe: Ekonomi AC</p>
                            <p>Kapasitas: 50 Kursi</p>
                            <p>Trayek: Semarang - Bandung</p>
                        </div>
                    </div>
                    <div class="armada-card">
                        <img src="../assets/img/armada13.jpg" class="armada-image" alt="Bus Pahala Kencana Ekonomi"
                            loading="lazy">
                        <div class="armada-info">
                            <h3>PO Pahala Kencana</h3>
                            <p>Tipe: Ekonomi AC</p>
                            <p>Kapasitas: 49 Kursi</p>
                            <p>Trayek: Jakarta - Madura</p>
                        </div>
                    </div>
                    <div class="armada-card">
                        <img src="../assets/img/armada14.jpg" class="armada-image" alt="Bus Medan Jaya" loading="lazy">
                        <div class="armada-info">
                            <h3>PO Medan Jaya</h3>
                            <p>Tipe: Ekonomi AC</p>
                            <p>Kapasitas: 52 Kursi</p>
                            <p>Trayek: Medan - Pekanbaru</p>
                        </div>
                    </div>
                    <div class="armada-card">
                        <img src="../assets/img/armada15.jpg" class="armada-image" alt="Bus Budiman" loading="lazy">
                        <div class="armada-info">
                            <h3>PO Budiman</h3>
                            <p>Tipe: Ekonomi AC</p>
                            <p>Kapasitas: 48 Kursi</p>
                            <p>Trayek: Tasikmalaya - Jakarta</p>
                        </div>
                    </div>
                    <div class="armada-card">
                        <img src="../assets/img/armada16.jpg" class="armada-image" alt="Bus Sinar Jaya Ekonomi"
                            loading="lazy">
                        <div class="armada-info">
                            <h3>PO Sinar Jaya</h3>
                            <p>Tipe: Ekonomi AC</p>
                            <p>Kapasitas: 50 Kursi</p>
                            <p>Trayek: Jakarta - Purwokerto</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="footer-admin">
        <p>&copy; 2025 PO BUS JAYA BAKTI | Armada Non Ekonomi & Ekonomi</p>
    </footer>
</body>

</html>