<?php
session_start();
if ($_SESSION['level'] == "") {
    header("location:index.php");
}
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemesanan Tiket - PO BUS INDONESIA RAYA</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    
</head>

<body class="body-admin">
    <!-- HEADER -->
    <header class="header-admin">
        <h1>🚍 PO BUS INDONESIA RAYA</h1>
        <nav class="navbar-admin">
            <ul>
                <li><a href="halaman_admin.php">Dashboard</a></li>
                <li><a href="armada-bus.php">Data Armada Bus</a></li>
                <li><a href="tabel_pemesanan.php" class="active">Data Pemesanan</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="keluar.php" class="logout-btn-admin">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <main class="main-pemesanan">
        <section class="pemesanan-section">
            <h2 class="pemesanan-title">Data Pemesanan Tiket Bus</h2>

            <!-- FILTER & SEARCH BAR -->
            <div class="pemesanan-actions">
                <div class="filter-bar">
                    <input type="text" id="searchInput" placeholder="🔎 Cari nama penumpang...">

                    <select id="filterRute">
                        <option value="">-- Semua Rute --</option>
                        <?php
                        $rute_q = mysqli_query($koneksi, "SELECT DISTINCT tujuan FROM pobus_rute");
                        while ($r = mysqli_fetch_assoc($rute_q)) {
                            echo "<option value='{$r['tujuan']}'>{$r['tujuan']}</option>";
                        }
                        ?>
                    </select>

                    <select id="sortData">
                        <option value="">-- Urutkan --</option>
                        <option value="tgl_asc">Tanggal Berangkat (A-Z)</option>
                        <option value="tgl_desc">Tanggal Berangkat (Z-A)</option>
                        <option value="harga_asc">Harga Termurah</option>
                        <option value="harga_desc">Harga Termahal</option>
                    </select>

                    <button onclick="loadData()" id="btnTerapkan">Terapkan</button>
                    <a href="tambah-data.php" class="pemesanan-btn tambah">+ Tambah Data Pemesan</a>
                    <a href="cetak.php" target="_blank" class="pemesanan-btn cetak">Cetak</a>
                </div>
            </div>

            <!-- TABEL -->
            <div class="pemesanan-card">
                <table class="pemesanan-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Penumpang</th>
                            <th>Alamat</th>
                            <th>No Telpon</th>
                            <th>Bus</th>
                            <th>Rute</th>
                            <th>Tanggal Berangkat</th>
                            <th>Jam Berangkat</th>
                            <th>Harga</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan di-load oleh AJAX dari fetch_pemesanan.php -->
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="footer-pemesanan">
        <p>&copy; 2025 PO BUS JAYA BAKTI | Design Modern Pemesanan 2025</p>
    </footer>

    <!-- POPUP KONFIRMASI -->
    <div id="popupHapus" class="popup-hapus" style="display:none;">
        <div class="popup-content">
            <h3>Konfirmasi Hapus</h3>
            <p>Apakah Anda yakin ingin menghapus data ini?</p>
            <div class="popup-actions">
                <a id="btnYaHapus" href="#" class="pemesanan-btn hapus">Ya, Hapus</a>
                <button onclick="tutupPopup()" class="pemesanan-btn batal">Batalkan</button>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function konfirmasiHapus(id) {
        $("#popupHapus").show();
        $("#btnYaHapus").attr("href", "hapus.php?tiket_id=" + id);
    }

    function tutupPopup() {
        $("#popupHapus").hide();
    }

    function loadData() {
        var search = $("#searchInput").val();
        var rute = $("#filterRute").val();
        var sort = $("#sortData").val();

        $.ajax({
            url: "fetch_pemesanan.php",
            type: "POST",
            data: {
                search: search,
                rute: rute,
                sort: sort
            },
            beforeSend: function() {
                $("table.pemesanan-table tbody").html(
                    "<tr><td colspan='10' style='text-align:center;padding:10px'>⏳ Memuat data...</td></tr>"
                );
            },
            success: function(data) {
                $("table.pemesanan-table tbody").html(data);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                $("table.pemesanan-table tbody").html(
                    "<tr><td colspan='10' style='text-align:center;color:red;padding:10px'>⚠️ Gagal memuat data!</td></tr>"
                );
            }
        });
    }

    $(document).ready(function() {
        $(document).ready(function() {
            // 🔄 Load awal
            loadData();

            // Filter, Sort, dan Search aktif saat klik tombol Terapkan
            $("#btnTerapkan").on("click", function() {
                loadData();
            });
        });


    });

    // ✅ Cek apakah ada parameter "status=deleted" di URL
    $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('status') === 'deleted') {
            alert("✅ Data pemesanan berhasil dihapus!");
            // Hapus param dari URL agar tidak muncul lagi saat refresh
            window.history.replaceState({}, document.title, "tabel_pemesanan.php");
        }
    });
    </script>

</body>

</html>