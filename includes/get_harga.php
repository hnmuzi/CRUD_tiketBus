<?php
include 'koneksi.php';

if (isset($_GET['rute_id'])) {
    $rute_id = intval($_GET['rute_id']);
    $result = mysqli_query($koneksi, "SELECT harga FROM pobus_rute WHERE rute_id=$rute_id");

    if ($row = mysqli_fetch_assoc($result)) {
        echo $row['harga'];
    } else {
        echo 0;
    }
} else {
    echo 0;
}