<?php
// Koneksi database
include 'koneksi.php';

// Tangkap data dari form
$tiket_id      = $_POST['tiket_id'];
$nama_pemesan  = $_POST['nama_pemesan'];
$alamat        = $_POST['alamat'];
$no_telpn      = $_POST['no_telpn'];
$bus_id        = $_POST['bus_id'];
$rute_id       = $_POST['rute_id'];
$tgl_berangkat = $_POST['tgl_berangkat'];
$jam_berangkat = $_POST['jam_berangkat'];
$harga         = $_POST['harga'];

// Update data tiket
$query = "UPDATE pobus_tiket 
          SET nama_pemesan='$nama_pemesan',
              alamat='$alamat',
              no_telpn='$no_telpn',
              bus_id='$bus_id',
              rute_id='$rute_id',
              tgl_berangkat='$tgl_berangkat',
              jam_berangkat='$jam_berangkat',
              harga='$harga'
          WHERE tiket_id='$tiket_id'";

mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

// Kembali ke tabel pemesanan
header("Location: tabel_pemesanan.php");
exit;