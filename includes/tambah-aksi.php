<?php
include 'koneksi.php';
session_start();

// Cek login
if (!isset($_SESSION['id']) || !isset($_SESSION['level'])) {
    header("Location: index.php");
    exit;
}

// Tangkap data dari form
$nama_pemesan   = $_POST['nama_pemesan'];
$alamat         = $_POST['alamat'];
$no_telpn       = $_POST['no_telpn'];
$bus_id         = $_POST['bus_id'];
$rute_id        = $_POST['rute_id'];
$tgl_berangkat  = $_POST['tgl_berangkat'];
$jam_berangkat  = $_POST['jam_berangkat'];

// Ambil harga asli dari tabel rute
$query = mysqli_query($koneksi, "SELECT harga FROM pobus_rute WHERE rute_id='$rute_id'");
$data  = mysqli_fetch_assoc($query);
$harga = $data['harga'];

// Ambil user_id dari session
$user_id = $_SESSION['id'];

// Insert ke tabel tiket
$stmt = $koneksi->prepare("INSERT INTO pobus_tiket 
    (user_id, nama_pemesan, alamat, no_telpn, bus_id, rute_id, tgl_berangkat, jam_berangkat, harga) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param(
    "isssiisss",
    $user_id, 
    $nama_pemesan, 
    $alamat, 
    $no_telpn, 
    $bus_id, 
    $rute_id, 
    $tgl_berangkat, 
    $jam_berangkat, 
    $harga
);
$stmt->execute();

// Redirect sesuai role
if ($_SESSION['level'] == "admin") {
    header("Location: tabel_pemesanan.php");
} else {
    header("Location: riwayat.php");
}
exit;
