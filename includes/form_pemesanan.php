<?php
session_start();

// cek apakah user sudah login
if (!isset($_SESSION['username']) || $_SESSION['level'] != "user") {
  header("location:index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Tiket - PO BUS JAYA BAKTI</title>
    <link rel="stylesheet" href="../assets/css/user.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body class="form-pemesanan-body">

    <!-- HEADER + NAVBAR -->
    <header class="form-pemesanan-header">
        <h1>🚍 PO BUS JAYA BAKTI</h1>
        <nav class="form-pemesanan-navbar">
            <ul>
                <li><a href="halaman_user.php">Beranda</a></li>
                <li><a href="form_pemesanan.php" style="background:#ffd700;color:#000;">Pesan Tiket</a></li>
                <li><a href="riwayat.php">Riwayat Saya</a></li>
                <li><a href="about-user.php">About</a></li>
                <li><a href="keluar.php" class="form-pemesanan-logout">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <main class="form-pemesanan-container">
        <div class="form-pemesanan-card">
            <h2>📝 Form Pemesanan Tiket</h2>
            <?php include 'koneksi.php'; ?>

            <form method="post" action="tambah-aksi.php" class="form-pemesanan-form">

                <!-- Nama -->
                <div class="form-pemesanan-group">
                    <label for="nama_pemesan">Nama Pemesan</label>
                    <input type="text" id="nama_pemesan" name="nama_pemesan" required>
                </div>

                <!-- Alamat -->
                <div class="form-pemesanan-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" required>
                </div>

                <!-- No Telpon -->
                <div class="form-pemesanan-group">
                    <label for="no_telpn">No Telpon</label>
                    <input type="text" id="no_telpn" name="no_telpn" placeholder="08xxxxxxxxxx" required>
                </div>

                <!-- Bus -->
                <div class="form-pemesanan-group">
                    <label for="bus-select">Nama Bus</label>
                    <select name="bus_id" id="bus-select" required>
                        <option value="">-- Pilih Bus --</option>
                        <?php
            $query = mysqli_query($koneksi, "SELECT * FROM pobus_bus ORDER BY nama_bus ASC");
            while ($bus = mysqli_fetch_assoc($query)) {
              echo "<option value='{$bus['bus_id']}' 
                        data-kategori='{$bus['kategori']}' 
                        data-kapasitas='{$bus['kapasitas']}'>
                        {$bus['nama_bus']} - {$bus['tipe']} - {$bus['kategori']} ({$bus['kapasitas']} kursi)
                    </option>";
            }
            ?>
                    </select>
                    <p id="bus-info" class="form-pemesanan-info"></p>
                </div>

                <!-- Rute -->
                <div class="form-pemesanan-group">
                    <label for="rute-select">Tujuan</label>
                    <select name="rute_id" id="rute-select" required>
                        <option value="">-- Pilih Tujuan --</option>
                        <?php
            $query = mysqli_query($koneksi, "SELECT * FROM pobus_rute ORDER BY asal, tujuan ASC");
            while ($rute = mysqli_fetch_assoc($query)) {
              echo "<option value='{$rute['rute_id']}' data-harga='{$rute['harga']}'>
                      {$rute['asal']} → {$rute['tujuan']}
                    </option>";
            }
            ?>
                    </select>
                </div>

                <!-- Harga -->
                <div class="form-pemesanan-group">
                    <label for="harga">Harga</label>
                    <input type="text" id="harga" name="harga" readonly required>
                </div>

                <!-- Tanggal -->
                <div class="form-pemesanan-group">
                    <label for="tgl_berangkat">Tanggal Berangkat</label>
                    <input type="date" id="tgl_berangkat" name="tgl_berangkat" required>
                </div>

                <!-- Jam -->
                <div class="form-pemesanan-group">
                    <label for="jam_berangkat">Jam Berangkat</label>
                    <input type="time" id="jam_berangkat" name="jam_berangkat" required>
                </div>

                <!-- Submit -->
                <div class="form-pemesanan-group">
                    <button type="submit" class="form-pemesanan-btn">💾 Simpan Pemesanan</button>
                </div>
            </form>
        </div>
    </main>

    <script>
    // Dropdown Bus → tampilkan info
    const busSelect = document.getElementById('bus-select');
    const busInfo = document.getElementById('bus-info');

    busSelect.addEventListener('change', () => {
        const option = busSelect.selectedOptions[0];
        busInfo.textContent = option.value !== '' ?
            `Kelas: ${option.dataset.kategori}, Kapasitas: ${option.dataset.kapasitas} kursi` :
            '';
    });

    // Dropdown Rute → isi harga otomatis
    const ruteSelect = document.getElementById('rute-select');
    const hargaInput = document.getElementById('harga');

    ruteSelect.addEventListener('change', () => {
        const option = ruteSelect.selectedOptions[0];
        hargaInput.value = option.value !== '' ? option.dataset.harga : '';
    });
    </script>

</body>

</html>