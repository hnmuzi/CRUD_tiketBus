<?php
include 'koneksi.php';

$search = isset($_POST['search']) ? mysqli_real_escape_string($koneksi, $_POST['search']) : '';
$rute   = isset($_POST['rute']) ? mysqli_real_escape_string($koneksi, $_POST['rute']) : '';
$sort   = isset($_POST['sort']) ? $_POST['sort'] : '';

$query = "SELECT t.*, b.nama_bus, r.tujuan, r.harga 
          FROM pobus_tiket t
          LEFT JOIN pobus_bus b ON t.bus_id = b.bus_id
          LEFT JOIN pobus_rute r ON t.rute_id = r.rute_id
          WHERE 1=1";

// ✅ Search nama penumpang
if (!empty($search)) {
    $query .= " AND t.nama_pemesan LIKE '%$search%'";
}

// ✅ Filter rute
if (!empty($rute)) {
    $query .= " AND r.tujuan = '$rute'";
}

// ✅ Sorting
if ($sort == "tgl_asc") {
    $query .= " ORDER BY t.tgl_berangkat ASC";
} elseif ($sort == "tgl_desc") {
    $query .= " ORDER BY t.tgl_berangkat DESC";
} elseif ($sort == "harga_asc") {
    $query .= " ORDER BY r.harga ASC";
} elseif ($sort == "harga_desc") {
    $query .= " ORDER BY r.harga DESC";
} else {
    $query .= " ORDER BY t.tiket_id DESC";
}

$data = mysqli_query($koneksi, $query);

$no = 1;
while ($d = mysqli_fetch_assoc($data)) {
    echo "<tr>
            <td>{$no}</td>
            <td>" . htmlspecialchars($d['nama_pemesan']) . "</td>
            <td>" . htmlspecialchars($d['alamat']) . "</td>
            <td>" . htmlspecialchars($d['no_telpn']) . "</td>
            <td>" . htmlspecialchars($d['nama_bus'] ?? '-') . "</td>
            <td>" . htmlspecialchars($d['tujuan'] ?? '-') . "</td>
            <td>" . htmlspecialchars($d['tgl_berangkat']) . "</td>
            <td>" . htmlspecialchars($d['jam_berangkat']) . "</td>
            <td>Rp " . number_format($d['harga'], 0, ',', '.') . "</td>
            <td class='opsi'>
                <a href='edit.php?id={$d['tiket_id']}' class='pemesanan-btn edit'>Edit</a>
                <a href='#' class='pemesanan-btn hapus' onclick='konfirmasiHapus({$d['tiket_id']})'>Hapus</a>
            </td>
        </tr>";
    $no++;
}