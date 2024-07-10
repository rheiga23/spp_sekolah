<?php
$koneksi = mysqli_connect('localhost','root','','sppujikom');


if(isset($_POST['bhapus'])){
	global $koneksi;
    $kelas_id = $_POST['kelas_id'];
    $hapus = mysqli_query($koneksi, "DELETE FROM kelas WHERE kelas_id ='$kelas_id'");

    if ($hapus){
        echo "<script>
        alert('Hapus Data Sukses !');
        document.location.href='../datakelas.php';
        </script>";
    } else {
        echo "<script>
        alert('Hapus Data Gagal !');
        document.location.href='../datakelas.php';
        </script>";
    }
}
?>