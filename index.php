<?php
session_start();
require 'koneksi.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query untuk mencari data user berdasarkan username
    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        // Memeriksa apakah password cocok
        if ($password === $row["password1"]) {
            // Password cocok, buat session dan redirect ke halaman selanjutnya
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["nama"] =$row['nama'];
            $_SESSION["username"] = $row["username"];
            echo "<script>
                    alert('Berhasil Login');
                  document.location.href='dashboard.php';
                  </script>";
            exit;
        } else {
            // Password tidak cocok
            echo "<script>
                    alert('Password Salah! Masukan Password Dengan Benar');
                  document.location.href='index.php';
                  </script>";
        }
    } else {
        // Username tidak ditemukan
        echo "<script>
        alert('Usename Salah! Masukan Username Dengan Benar');
        document.location.href='index.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .login-container h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-container form {
            margin-top: 20px;
        }
        .login-container form .form-control {
            border-radius: 20px;
        }
        .login-container form .btn-primary {
            border-radius: 20px;
            width: 100%;
        }
        .login-container .register-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="login-container">
    
    <h1>LOGIN SPP | PEMBAYARAN</h1>
    <form action="" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <button type="submit" name="login"class="btn btn-primary">Login</button>
    </form>
    <div class="register-link">
        Belum Punya Akun? <a href="registrasi.php">Registrasi</a>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
