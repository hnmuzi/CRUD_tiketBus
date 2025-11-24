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
    <title>Cetak Data Pemesanan Tiket</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background: url("../assets/img/bg-admin.jpg") no-repeat center center fixed;
        background-size: cover;
        color: #111;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #ffd700;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
    }

    table {
        border-collapse: collapse;
        width: 100%;
        font-size: 14px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    table th {
        background: #ffd700;
        color: #000;
        padding: 10px;
        border: 1px solid #333;
    }

    table td {
        padding: 8px;
        text-align: center;
        border: 1px solid #ccc;
        color: #111;
    }

    tr:nth-child(even) {
        background: #f9f9f9;
    }

    tr:hover {
        background: #f1f1f1;
    }

    .footer {
        margin-top: 30px;
        text-align: right;
        font-size: 13px;
        color: #fff;
        text-shadow: 1px 1px 2px #000;
    }

    .no-print {
        margin-top: 20px;
        text-align: center;
    }

    .no-print a {
        display: inline-block;
        padding: 8px 15px;
        background: #ffd700;
        color: #000;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        transition: 0.3s;
    }

    .no-print a:hover {
        background: #e6c200;
    }

    @media print {
        body {
            background: #fff;
            color: #000;
        }

        .no-print {
            display: none;
        }

        table {
            box-shadow: none;
        }
    }
    </style>
</head>

<body onload="window.print()">

    <h2>📑 Laporan Data Pemesanan Tiket Bus<br>PO BUS JAYA BAKTI</h2>

    <table>
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
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = "SELECT t.*, b.nama_bus, r.asal, r.tujuan, r.harga 
                      FROM pobus_tiket t
                      LEFT JOIN pobus_bus b ON t.bus_id = b.bus_id
                      LEFT JOIN pobus_rute r ON t.rute_id = r.rute_id
                      ORDER BY t.tiket_id ASC";
            $data = mysqli_query($koneksi, $query);
            while ($d = mysqli_fetch_assoc($data)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($d['nama_pemesan']); ?></td>
                <td><?= htmlspecialchars($d['alamat']); ?></td>
                <td><?= htmlspecialchars($d['no_telpn']); ?></td>
                <td><?= htmlspecialchars($d['nama_bus'] ?? '-'); ?></td>
                <td><?= htmlspecialchars(($d['asal'] ?? '-') . " - " . ($d['tujuan'] ?? '-')); ?></td>
                <td><?= htmlspecialchars($d['tgl_berangkat']); ?></td>
                <td><?= htmlspecialchars($d['jam_berangkat']); ?></td>
                <td>Rp <?= number_format($d['harga'], 0, ',', '.'); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: <?= date("d-m-Y H:i"); ?></p>
        <p>Admin: <?= $_SESSION['username'] ?? 'Administrator'; ?></p>
    </div>

    <div class="no-print">
        <a href="tabel_pemesanan.php">⬅️ Kembali</a>
        <a href="#" onclick="window.print()">🖨️ Print</a>
    </div>
</body>

</html>