<?php
session_start();
require('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        echo "<script>
                alert('Username dan Password wajib diisi!');
                window.history.back();
              </script>";
        exit;
    }

    $tables = ['admin', 'user'];

    foreach ($tables as $table) {
        $stmt = $koneksi->prepare("SELECT id, username, password, level FROM $table WHERE username = ? LIMIT 1");
        if (!$stmt) {
            die("Query error: " . $koneksi->error);
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $data = $result->fetch_assoc();

            if (password_verify($password, $data['password'])) {
                $_SESSION['id']       = $data['id'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['level']    = $data['level'];

                if ($data['level'] === 'admin') {
                    header("Location: halaman_admin.php");
                } else {
                    header("Location: halaman_user.php");
                }
                exit;
            } else {
                echo "<script>
                        alert('Password salah!');
                        window.history.back();
                      </script>";
                exit;
            }
        }
        $stmt->close();
    }

    echo "<script>
            alert('Username tidak ditemukan!');
            window.history.back();
          </script>";
    exit;
}
?>

<!-- HTML Form Login -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <style>
    .password-wrapper {
        position: relative;
        width: 423px;
    }

    .password-wrapper input {
        width: 100px;
        margin-right: 20px;
        /* ruang untuk ikon mata */
        box-sizing: border-box;
    }

    .password-wrapper input:not(:placeholder-shown) {
        background-color: #e6f0ff;
        /* biru muda */
        border: 1px solid #4a90e2;
        box-shadow: 0 0 8px rgba(118, 75, 162, 0.3);
    }

    .password-wrapper form input:focus,
    .password-wrapper form select:focus {
        border-color: #764ba2;
        box-shadow: 0 0 8px rgba(118, 75, 162, 0.3);
        outline: none;
    }

    .toggle-password {
        position: absolute;
        right: 40px;
        top: 38%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
    }

    .toggle-password svg {
        width: 20px;
        height: 20px;
        fill: #555;
    }
    </style>
</head>

<body class="masuk-page">
    <div class="login-container">
        <h2>Masuk Akun</h2>
        <form method="post" action="">
            <label>Username</label>
            <input type="text" name="username" placeholder="Username" required />

            <label>Password</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="password" placeholder="Password" required />
                <button type="button" class="toggle-password" id="togglePassword">
                    <!-- ikon mata -->
                    <svg xmlns="http://www.w3.org/2000/svg" id="eyeIcon" viewBox="0 0 24 24">
                        <path
                            d="M12 4.5C7.305 4.5 3.135 7.36 1.5 12c1.635 4.64 5.805 7.5 10.5 7.5s8.865-2.86 10.5-7.5c-1.635-4.64-5.805-7.5-10.5-7.5zm0 12a4.5 4.5 0 110-9 4.5 4.5 0 010 9z" />
                        <circle cx="12" cy="12" r="2.5" />
                    </svg>
                </button>
            </div>

            <input type="submit" value="Masuk" />
        </form>

        <div class="back-register">
            <p>Belum punya akun? <a href="registrasi.php">Daftar</a></p>
        </div>
    </div>

    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const eyeIcon = document.querySelector('#eyeIcon');

    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Ganti ikon (mata terbuka / tertutup)
        if (type === 'password') {
            eyeIcon.setAttribute('d',
                'M12 4.5C7.305 4.5 3.135 7.36 1.5 12c1.635 4.64 5.805 7.5 10.5 7.5s8.865-2.86 10.5-7.5c-1.635-4.64-5.805-7.5-10.5-7.5zm0 12a4.5 4.5 0 110-9 4.5 4.5 0 010 9z'
            );
        } else {
            eyeIcon.setAttribute('d',
                'M2 2l20 20M12 4.5C7.305 4.5 3.135 7.36 1.5 12c1.635 4.64 5.805 7.5 10.5 7.5 2.09 0 4.026-.546 5.709-1.5M9 9a4.5 4.5 0 016 6'
            );
        }
    });
    </script>
</body>

</html>