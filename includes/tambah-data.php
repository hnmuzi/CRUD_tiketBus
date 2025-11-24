<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pemesanan Tiket - PO BUS JAYA BAKTI</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
</head>

<body class="body-admin">
    <!-- HEADER + NAVBAR -->
    <header class="header-admin">
        <h1>🚍 PO BUS JAYA BAKTI</h1>
        <nav class="navbar-admin">
            <ul>
                <li><a href="halaman_admin.php">Dashboard</a></li>
                <li><a href="armada-bus.php">Data Armada Bus</a></li>
                <li><a href="tabel_pemesanan.php" style="background:#ffd700;color:#000;">Data Pemesanan</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="keluar.php" class="logout-btn-admin">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="tambah-data-container">
        <div class="card">
            <h2>ISI PEMESANAN TIKET</h2>
            <?php
            include 'koneksi.php';
            ?>

            <form method="post" action="tambah-aksi.php" class="tambah-data-form">
                <div class="form-group">
                    <label>Nama Pemesan</label>
                    <input type="text" name="nama_pemesan" required>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" required>
                </div>

                <div class="form-group">
                    <label>No Telpon</label>
                    <input type="text" name="no_telpn" placeholder="08xxxxxxxxxx" required>
                </div>

                <div class="form-group">
                    <label>Nama Bus</label>
                    <select name="bus_id" id="bus-select" required>
                        <option value="">-- Pilih Bus --</option>
                        <?php
                        // Ambil data bus dari database
                        $query = mysqli_query($koneksi, "SELECT * FROM pobus_bus ORDER BY nama_bus ASC");
                        while ($bus = mysqli_fetch_assoc($query)) {
                            echo "<option value='{$bus['bus_id']}' data-kategori='{$bus['kategori']}' data-kapasitas='{$bus['kapasitas']}'>
                        {$bus['nama_bus']} - {$bus['tipe']} - {$bus['kategori']} ({$bus['kapasitas']} kursi)
                      </option>";
                        }
                        ?>
                    </select>
                    <p id="bus-info"></p>
                </div>

                <div class="form-group">
                    <label>Tujuan</label>
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

                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" name="harga" id="harga" readonly required>
                </div>

                <div class="form-group">
                    <label>Tanggal Berangkat</label>
                    <input type="date" name="tgl_berangkat" required>
                </div>

                <div class="form-group">
                    <label>Jam Berangkat</label>
                    <input type="time" name="jam_berangkat" required>
                </div>

                <div class="form-group">
                    <input type="submit" value="SIMPAN" class="btn-submit">
                </div>
            </form>

            <script>
            // Dropdown Bus → info otomatis
            const busSelect = document.getElementById('bus-select');
            const busInfo = document.getElementById('bus-info');

            busSelect.addEventListener('change', () => {
                const option = busSelect.selectedOptions[0];
                if (option.value !== '') {
                    busInfo.textContent =
                        `Kelas: ${option.dataset.kategori}, Kapasitas: ${option.dataset.kapasitas} kursi`;
                } else {
                    busInfo.textContent = '';
                }
            });

            // Dropdown Rute → otomatis isi harga
            const ruteSelect = document.getElementById('rute-select');
            const hargaInput = document.getElementById('harga');

            ruteSelect.addEventListener('change', () => {
                const option = ruteSelect.selectedOptions[0];
                hargaInput.value = option.value !== '' ? option.dataset.harga : '';
            });
            </script>


</body>

</html>