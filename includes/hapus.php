<?php
include 'koneksi.php';

// Tangkap id
$id = $_GET['tiket_id'];

// Hapus data
mysqli_query($koneksi, "DELETE FROM pobus_tiket WHERE tiket_id='$id'");

// Redirect dengan pesan sukses
header("location:tabel_pemesanan.php?status=deleted");
exit;