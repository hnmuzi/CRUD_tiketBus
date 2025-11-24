<?php 
	session_start();
 	// Bagian untuk mengecek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:index.php");
	}
	?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PO BUS JAYA BAKTI</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <body>
	<header class="header">
    <h1>PO BUS JAYA BAKTI</h1>
    <p>Pemesanan Tiket Mudah, Cepat dan Terpercaya</p>
	<marquee><b><i> <tr>Selamat Datang <b><?php echo $_SESSION['username']; ?>!</b></tr></i></marquee></b>
  </header>

  <nav class="navbar">
    <ul>
      <li class="utama"><a href="beranda.php">Beranda</a></li>
      <li class="utama"><a href="form_registrasi.php">Pemesanan Tiket</a></li>
      <li class="utama"><a href="tabel_pemesanan.php">Data Pemesanan Tiket</a></li>
	   <li class="utama"><a href="about.php">About</a></li>
        <li class="utama logout"><a href="logout.php">Logout</a></li>
    </ul>
  </nav>

  <main class="main">
    <div class="content">
      <h2>TITLE 1</h2>
     DESKRIPSI WEB
    </div>
    
    
  </main>

  <footer class="footer">
    <p>Copyright &copy 2022 Intan Cahyani Putri</p>
  </footer>

</body>

</html>