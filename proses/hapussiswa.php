<?php
$koneksi = mysqli_connect('localhost','root','','sppujikom');


if(isset($_POST['bhapus'])){
	global $koneksi;
    $id = $_POST['id'];
    $hapus = mysqli_query($koneksi, "DELETE FROM siswa WHERE id ='$id'");

    if ($hapus){
        echo "<script>
        alert('Hapus Data Sukses !');
        document.location.href='../datasiswa.php';
        </script>";
    } else {
        echo "<script>
        alert('Hapus Data Gagal !');
        document.location.href='../datasiswa.php';
        </script>";
    }
}
?>