<?php
include 'koneksi.php';

// Pastikan ada id di URL
if (!isset($_GET['id'])) {
	echo "ID tiket tidak ditemukan!";
	exit;
}

$id = $_GET['id'];

// Ambil data tiket berdasarkan id
$result = mysqli_query($koneksi, "SELECT * FROM pobus_tiket WHERE tiket_id='$id'");
$d = mysqli_fetch_assoc($result);

if (!$d) {
	echo "Data tiket tidak ditemukan!";
	exit;
}

// Ambil data bus dan rute
$bus_result = mysqli_query($koneksi, "SELECT * FROM pobus_bus");
$rute_result = mysqli_query($koneksi, "SELECT * FROM pobus_rute");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <title>Edit Tiket Bus</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
</head>

<body class="body-edit">
    <div class="edit-container">
        <h2 class="edit-title">✏️ Edit Data Pemesan</h2>

        <form method="post" action="proses_update.php" class="edit-form">
            <input type="hidden" name="tiket_id" value="<?php echo $d['tiket_id']; ?>">

            <table>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama_pemesan"
                            value="<?php echo htmlspecialchars($d['nama_pemesan']); ?>" class="edit-input" required>
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input type="text" name="alamat" value="<?php echo htmlspecialchars($d['alamat']); ?>"
                            class="edit-input" required></td>
                </tr>
                <tr>
                    <td>No Telepon</td>
                    <td><input type="text" name="no_telpn" value="<?php echo htmlspecialchars($d['no_telpn']); ?>"
                            class="edit-input" required></td>
                </tr>
                <tr>
                    <td>Nama Bus</td>
                    <td>
                        <select name="bus_id" class="edit-select" required>
                            <option value="">-- Pilih Bus --</option>
                            <?php while ($bus = mysqli_fetch_assoc($bus_result)) { ?>
                            <option value="<?php echo $bus['bus_id']; ?>"
                                <?php echo ($bus['bus_id'] == $d['bus_id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($bus['nama_bus']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Rute</td>
                    <td>
                        <select name="rute_id" id="rute" class="edit-select" required>
                            <option value="">-- Pilih Rute --</option>
                            <?php while ($rute = mysqli_fetch_assoc($rute_result)) { ?>
                            <option value="<?php echo $rute['rute_id']; ?>"
                                <?php echo ($rute['rute_id'] == $d['rute_id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($rute['asal'] . " - " . $rute['tujuan']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Berangkat</td>
                    <td><input type="date" name="tgl_berangkat" value="<?php echo $d['tgl_berangkat']; ?>"
                            class="edit-input" required></td>
                </tr>
                <tr>
                    <td>Jam Berangkat</td>
                    <td><input type="time" name="jam_berangkat" value="<?php echo $d['jam_berangkat']; ?>"
                            class="edit-input" required></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td><input type="number" name="harga" id="harga" value="<?php echo $d['harga']; ?>"
                            class="edit-input" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="edit-btn">💾 Simpan</button>
                        <a href="tabel_pemesanan.php" class="edit-btn batal-btn">❌ Batal</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script>
    document.getElementById("rute").addEventListener("change", function() {
        var rute_id = this.value;
        if (rute_id !== "") {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_harga.php?rute_id=" + rute_id, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById("harga").value = xhr.responseText.trim();
                } else {
                    console.error("Error: " + xhr.status);
                }
            };
            xhr.send();
        }
    });
    </script>
</body>

</html>