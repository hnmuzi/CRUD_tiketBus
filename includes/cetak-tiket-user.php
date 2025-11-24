<?php
session_start();
require __DIR__ . "/koneksi.php";
require __DIR__ . "/fpdf186/fpdf.php"; // sesuaikan path

// Pastikan user login
if (!isset($_SESSION['id']) || $_SESSION['level'] !== "user") {
    die("⚠️ Akses ditolak, silakan login sebagai user.");
}

// Validasi tiket_id
if (!isset($_GET['tiket_id']) || !ctype_digit($_GET['tiket_id'])) {
    die("⚠️ Tiket tidak ditemukan!");
}
$tiket_id = (int) $_GET['tiket_id'];

// Ambil data tiket (hanya milik user login)
$query = "SELECT t.*, b.nama_bus, r.asal, r.tujuan 
          FROM pobus_tiket t
          JOIN pobus_bus b ON t.bus_id = b.bus_id
          JOIN pobus_rute r ON t.rute_id = r.rute_id
          WHERE t.tiket_id = ? AND t.user_id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("ii", $tiket_id, $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
$tiket = $result->fetch_assoc();

if (!$tiket) {
    die("⚠️ Data tiket tidak ditemukan atau bukan milik Anda!");
}

// === Fungsi untuk generate PDF ===
function generateTicketPDF($tiket) {
    $pdf = new FPDF('P','mm','A4');
    $pdf->AddPage();

    // Judul
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,iconv('UTF-8','windows-1252','Tiket Pemesanan - PO BUS JAYA BAKTI'),0,1,'C');
    $pdf->Ln(5);

    // Kotak detail tiket
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190,10,'Detail Tiket',1,1,'C');

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(50,10,'Nama Pemesan',1,0);
    $pdf->Cell(140,10,$tiket['nama_pemesan'],1,1);

    $pdf->Cell(50,10,'Bus',1,0);
    $pdf->Cell(140,10,$tiket['nama_bus'],1,1);

    $pdf->Cell(50,10,'Rute',1,0);
    $pdf->Cell(140,10,$tiket['asal'].' → '.$tiket['tujuan'],1,1);

    $pdf->Cell(50,10,'Tanggal',1,0);
    $pdf->Cell(140,10,date("d M Y", strtotime($tiket['tgl_berangkat'])),1,1);

    $pdf->Cell(50,10,'Jam',1,0);
    $pdf->Cell(140,10,date("H:i", strtotime($tiket['jam_berangkat'])),1,1);

    $pdf->Cell(50,10,'Harga',1,0);
    $pdf->Cell(140,10,"Rp ".number_format($tiket['harga'],0,',','.'),1,1);

    // Footer
    $pdf->Ln(10);
    $pdf->SetFont('Arial','I',10);
    $pdf->Cell(0,10,'Dicetak pada: '.date("d M Y H:i"),0,1,'R');

    return $pdf;
}

// Generate & Output PDF
$pdf = generateTicketPDF($tiket);
$pdf->Output("I", "Tiket-".$tiket['tiket_id'].".pdf");
