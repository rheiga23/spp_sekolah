<?php
require 'koneksi.php';

if (isset($_POST["register"])) {
$nama = $_POST["nama"];
$username = $_POST["username"];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];
$dibuat_pada = date('Y-m-d H:i:s'); // Waktu saat data dimasukkan

// Validasi password
if ($password1 !== $password2) {
    // Password tidak cocok
    echo "<script>
    alert('Konfirmasi Password Tidak Sesuai !');
  document.location.href='registrasi.php';
  </script>";
    exit;
}

// Insert data into database
$sql = "INSERT INTO admin (nama, username, password1, dibuat_pada) VALUES ('$nama', '$username', '$password1', '$dibuat_pada')";
if (mysqli_query($koneksi, $sql)) {
    // Registrasi berhasil
    echo "<script>
    alert('Berhasil anda Berhasil Membuat Akun !');
  document.location.href='index.php';x
  </script>";
    exit;
} else {
    // Error saat insert data
  
    echo "<script>
                    alert('Error Saat Insert $sql !');
                    document.location.href='registrasi.php';
          </script>";
    exit;
}
}
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .register-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .register-container form {
            margin-top: 20px;
        }
        .register-container form .form-control {
            border-radius: 20px;
        }
        .register-container form .btn-primary {
            border-radius: 20px;
            width: 100%;
        }
        .register-container .login-link {
            text-align: center;
            margin-top: 20px;
        }
        
    </style>
</head>
<body>

<div class="register-container">
    <h2>Form Registrasi</h2>
    <form action="" method="POST">
        <div class="form-group">

            <input type="text" class="form-control" name="nama" placeholder="Nama" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password1" placeholder="Password" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password2" placeholder="Konfirmasi Password" required>
        </div>
       
        <button type="submit" name="register"class="btn btn-primary">Registrasi</button>
    </form>
    <div class="login-link">
        Sudah Punya Akun? <a href="index.php">Login</a>
    </div>
</div>
<!-- Popup untuk pemberitahuan berhasil -->


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
