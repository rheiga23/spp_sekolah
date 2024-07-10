<?php

$koneksi = mysqli_connect('localhost', 'root', '', 'sppujikom');

//UBAH
if(null !== ($_POST['edit'] ?? null)){
    global $koneksi;
    $kelas_id = $_POST['kelas_id'];
    $nama_kelas = $_POST['nama_kelas'];
    $tgl = date('Y-m-d H:i:s');

    $update = mysqli_query($koneksi, "UPDATE kelas SET nama_kelas='$nama_kelas', dibuat_pada='$tgl' WHERE kelas_id='$kelas_id'");

    if($update){
        echo "<script>
        alert('Data Berhasil Di Update !');
        document.location.href='../datakelas.php';
        </script>";
    }else{
        echo "<script>
        alert('Data Gagal Di Update !');
        document.location.href='../datakelas.php';
        </script>";
    }
}
?>
