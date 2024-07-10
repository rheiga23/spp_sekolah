<?php
$koneksi = mysqli_connect('localhost','root','','sppujikom');

// Hapus Tahun
if(isset($_POST['bhapus'])){
    global $koneksi;
    $program_studi_id = $_POST['program_studi_id']; // Ambil nilai tahun_id dari form
    $hapus = mysqli_query($koneksi, "DELETE FROM program_studi WHERE program_studi_id ='$program_studi_id'");

     if ($hapus){
         echo "<script>
         alert('Hapus Data Sukses !');
         document.location.href='../dataprogramstudi.php';
         </script>";
     } else {
         echo "<script>
         alert('Hapus Data Gagal !');
         document.location.href='../dataprogramstudi.php';
         </script>";
     }
}
?>
