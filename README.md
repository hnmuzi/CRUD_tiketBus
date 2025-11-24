# 📘 Layanan Bus (PHP Native)

## 📌 Deskripsi Project
Layanan Bus adalah aplikasi berbasis **PHP Native** untuk mengelola layanan, data operasional, dan informasi pemesanan.  
Project ini ringan, mudah dipasang, dan tidak menggunakan framework sehingga bisa berjalan di semua server (Laragon, XAMPP, WAMP, atau hosting cPanel).

---

## 🚀 Fitur Utama
- CRUD data layanan bus  
- Manajemen pengguna / admin  
- Generate laporan (PDF)  
- Tampilan menggunakan **CSS murni**  
- Struktur sederhana, mudah dikembangkan  

---

## 🛠️ Persyaratan Sistem
- **PHP 7.4 – 8.2**
- **MySQL / MariaDB**
- Apache / Nginx
- phpMyAdmin (opsional)
- Laragon / XAMPP / WAMP (recommended: Laragon)

---

## 📥 Instalasi & Menjalankan

### 1️⃣ Clone Repository
```bash
git clone https://github.com/USERNAME/NAMA-REPO.git
cd NAMA-REPO
```

---

### 2️⃣ Buat Database
1. Buka phpMyAdmin  
2. Buat database dengan nama:
   ```
   layanan_bus
   ```
3. Import file SQL:
   ```
   config/pobus.sql
   ```

---

### 3️⃣ Konfigurasi Koneksi Database  
Edit file:

```
config/koneksi.php
```

Contoh konfigurasi:
```php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "layanan_bus";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
```

> Pada hosting cPanel, user/password database biasanya berbeda — sesuaikan dengan environment hosting.

---

### 4️⃣ Menjalankan Aplikasi

#### 📌 Laragon
Letakkan folder di:
```
D:/laragon/www/layanan-bus
```

Akses melalui:
```
http://layanan-bus.test/
```

#### 📌 XAMPP
Letakkan folder di:
```
C:/xampp/htdocs/layanan-bus
```

Akses:
```
http://localhost/layanan-bus/
```

---

## 📦 Struktur Folder
```
/layanan-bus
│── config/
│   ├── koneksi.php
│   └── pobus.sql
│
│── includes/
│   ├── header.php
│   ├── footer.php
│   ├── fpdf186/
│   └── lainnya...
│
│── css/
│   └── style.css
│
│── js/
│   └── app.js
│
│── pages/
│   └── semua halaman aplikasi
│
│── index.php
│── README.md
```

---

## 🔒 Akun Login Default
Jika project membutuhkan login, masukkan informasi di sini:

```
Username: admin
Password: admin123
```

*(Hapus bagian ini jika tidak ada fitur login.)*

---

## 🧪 Troubleshooting

### ❗ Database gagal terkoneksi
- Periksa user/password MySQL
- Pastikan database `layanan_bus` sudah dibuat
- Coba ganti host menjadi `127.0.0.1`

### ❗ PDF tidak muncul
- Pastikan folder `includes/fpdf186` lengkap
- Periksa konfigurasi `allow_url_fopen`

### ❗ CSS tidak terbaca
- Pastikan path benar:
  ```html
  <link rel="stylesheet" href="css/style.css">
  ```
- Jika pakai virtual host, pastikan domain benar

---

## 📄 Lisensi
Project dirilis menggunakan lisensi **MIT** atau lisensi lain sesuai kebutuhan Anda.

---

## 🤝 Kontribusi
Pull request dan issue sangat diterima.  
Gunakan commit yang jelas dan terstruktur.

