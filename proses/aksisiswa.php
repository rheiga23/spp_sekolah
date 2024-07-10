<?php
$koneksi = mysqli_connect('localhost','root','','sppujikom');
//TAMBAH SISWA
if(isset($_POST['bsubmit'])){
    global $koneksi;
    $nis = $_POST['nis'];
    $nama = $_POST['nama_siswa'];
    $kelas = $_POST['kelas_id'];
    $studi = $_POST['program_studi_id'];
    
    $selectsiswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");
        $cek = mysqli_num_rows($selectsiswa);
    if ($cek) {
            echo '<script>alert("NIS sudah ada");
            document.location.href="../datasiswa.php";
            </script>';
        }else{
    // menginput data ke database
    mysqli_query($koneksi,"INSERT INTO siswa VALUES('','$nis','$nama','$kelas','$studi')");
    echo"<script>
    
            alert('Data Berhasil Ditambahkan!');
            document.location.href = '../datasiswa.php';
    
         </script>";
    
    }
    }

    ?>
