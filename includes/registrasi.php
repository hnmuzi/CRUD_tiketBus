<?php
require('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama     = trim($_POST['nama']);
    $email    = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $level    = strtolower(trim($_POST['level'])); // user atau admin

    // Validasi field
    if (empty($nama) || empty($email) || empty($username) || empty($password) || empty($level)) {
        echo "<script>alert('Semua field wajib diisi!'); window.history.back();</script>";
        exit;
    }

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid!'); window.history.back();</script>";
        exit;
    }

    // Pilih tabel berdasarkan level
    $table = ($level === "admin") ? "admin" : "user";

    // Cek apakah username/email sudah ada
    $check = $koneksi->prepare("SELECT id FROM $table WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Email atau Username sudah terdaftar!'); window.history.back();</script>";
        $check->close();
        exit;
    }
    $check->close();

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert ke tabel sesuai level
    $stmt = $koneksi->prepare("INSERT INTO $table (nama, email, username, password, level) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $email, $username, $hashedPassword, $level);

    if ($stmt->execute()) {
        echo "<script>
                alert('Registrasi berhasil 🎉 Silakan login sekarang!');
                window.location.href='masuk.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Terjadi kesalahan! Coba lagi.');
                window.history.back();
              </script>";
        exit;
    }

    $stmt->close();
    $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Registrasi Akun</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
</head>

<body class="register-page">
    <div class="register-container">
        <h2>Registrasi Akun</h2>
        <form method="post" action="">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" placeholder="Nama lengkap" required />

            <label>Email</label>
            <input type="email" name="email" placeholder="Email aktif" required />

            <label>Username</label>
            <input type="text" name="username" placeholder="Username" required />

            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required />

            <label>Level</label>
            <select name="level" required>
                <option value="user" selected>User</option>
                <option value="admin">Admin</option>
            </select>

            <input type="submit" value="Register" />
        </form>

        <div class="back-login">
            <p>Sudah punya akun? <a href="masuk.php">Masuk</a></p>
        </div>
    </div>
</body>

</html>