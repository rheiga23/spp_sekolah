<?php

$koneksi = mysqli_connect('localhost', 'root', '', 'sppujikom');

//UBAH
if(null !== ($_POST['edit'] ?? null)){
    global $koneksi;
    $program_studi_id = $_POST['program_studi_id'];
    $programstudi = $_POST['nama_prodi'];
    $tgl = date('Y-m-d H:i:s');

    $update = mysqli_query($koneksi, "UPDATE program_studi SET nama_prodi='$programstudi', dibuat_pada='$tgl' WHERE program_studi_id='$program_studi_id'");

    if($update){
        echo "<script>
        alert('Data Berhasil Di Update !');
        document.location.href='../dataprogramstudi.php';
        </script>";
    }else{
        echo "<script>
        alert('Data Gagal Di Update !');
        document.location.href='../datakelas.php';
        </script>";
    }
}
?>
