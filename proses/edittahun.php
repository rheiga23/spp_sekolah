<?php

$koneksi = mysqli_connect('localhost', 'root', '', 'sppujikom');

//UBAH
if(null !== ($_POST['edit'])){
    global $koneksi;
    $id = $_POST['id'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $tgl = date('Y-m-d H:i:s');

    $update = mysqli_query($koneksi, "UPDATE tahun_ajaran SET tahun_ajaran='$tahun_ajaran', dibuat_pada='$tgl' WHERE id='$id'");

    if($update){
        echo "<script>
        alert('Data Berhasil Di Update !');
        document.location.href='../datatahunajaran.php';
        </script>";
    }else{
        echo "<script>
        alert('Data Gagal Di Update !');
        document.location.href='../datatahunajaran.php';
        </script>";
    }
}
?>
