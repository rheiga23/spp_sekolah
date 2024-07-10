<?php 
$koneksi = mysqli_connect('localhost','root','','sppujikom');


if(isset($_POST['hapus'])){
global $koneksi;

$id_tagihan = $_POST['id_tagihan'];
// menghapus data dari database
$hapus = mysqli_query($koneksi,"DELETE FROM tagihan WHERE id_tagihan='$id_tagihan'");

if ($hapus) {
	echo"<script>

		alert('Data Berhasil di hapus!');
		document.location.href = '../list_tagihan.php';

	 </script>";
}else{

echo "data gagal di hapus!";
}
}

?>