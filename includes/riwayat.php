<?php
session_start();
require("koneksi.php");

// Cek login
if (!isset($_SESSION['id']) || $_SESSION['level'] != "user") {
  header("location:index.php");
  exit;
}

$user_id = $_SESSION['id'];

// Ambil data tiket sesuai user login
$query = "SELECT t.*, b.nama_bus, r.asal, r.tujuan 
          FROM pobus_tiket t
          JOIN pobus_bus b ON t.bus_id = b.bus_id
          JOIN pobus_rute r ON t.rute_id = r.rute_id
          WHERE t.user_id = ?
          ORDER BY t.tgl_berangkat DESC, t.jam_berangkat DESC";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Pemesanan - PO BUS JAYA BAKTI</title>
  <link rel="stylesheet" href="../assets/css/user.css" />
</head>

<body class="body-riwayat">

  <!-- Header -->
  <header class="header-riwayat">
    <div class="logo-riwayat">
      🚍 <span>PO BUS JAYA BAKTI</span>
    </div>
    <nav class="nav-riwayat">
      <ul>
        <li><a href="halaman_user.php">Beranda</a></li>
        <li><a href="form_pemesanan.php">Pesan Tiket</a></li>
        <li><a href="riwayat.php" class="active">Riwayat Saya</a></li>
        <li><a href="about-user.php">About</a></li>
        <li><a href="keluar.php" class="logout-riwayat">Logout</a></li>
      </ul>
    </nav>
  </header>

  <!-- Main -->
  <main class="main-riwayat">
    <section class="card-riwayat">
      <h2>📜 Riwayat Pemesanan Tiket</h2>
      <div class="table-riwayat-wrapper">
        <table class="table-riwayat">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Penumpang</th>
              <th>Bus</th>
              <th>Rute</th>
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Harga</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $tgl = date("d M Y", strtotime($row['tgl_berangkat']));
                $jam = date("H:i", strtotime($row['jam_berangkat']));
                $harga = "Rp " . number_format($row['harga'], 0, ',', '.');

                $status = ($row['tgl_berangkat'] < date("Y-m-d")) ? "Selesai" : "Aktif";

                echo "<tr>
                            <td>{$no}</td>
                            <td>" . htmlspecialchars($row['nama_pemesan']) . "</td>
                            <td>" . htmlspecialchars($row['nama_bus']) . "</td>
                            <td>" . htmlspecialchars($row['asal']) . " → " . htmlspecialchars($row['tujuan']) . "</td>
                            <td>{$tgl}</td>
                            <td>{$jam}</td>
                            <td>{$harga}</td>
                            <td>{$status}</td>
                            <td>
                              <a href='cetak-tiket-user.php?tiket_id={$row['tiket_id']}' 
                                 target='_blank' class='btn-cetak'>Cetak</a>
                            </td>
                          </tr>";
                $no++;
              }
            } else {
              echo "<tr><td colspan='9' style='text-align:center; padding:15px;'>🚫 Belum ada pemesanan tiket.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer-riwayat">
    <p>&copy; <?= date("Y"); ?> PO BUS JAYA BAKTI. All rights reserved.</p>
  </footer>

</body>

</html>