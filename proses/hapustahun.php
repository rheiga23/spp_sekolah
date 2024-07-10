<?php
$koneksi = mysqli_connect('localhost','root','','sppujikom');

// Hapus Tahun
if(isset($_POST['bhapus'])){
    global $koneksi;
    $id = $_POST['id']; // Ambil nilai tahun_id dari form
    $hapus = mysqli_query($koneksi, "DELETE FROM tahun_ajaran WHERE id ='$id'");

     if ($hapus){
         echo "<script>
         alert('Hapus Data Sukses !');
         document.location.href='../datatahunajaran.php';
         </script>";
     } else {
         echo "<script>
         alert('Hapus Data Gagal !');
         document.location.href='../datatahunajaran.php';
         </script>";
     }
}
?>
