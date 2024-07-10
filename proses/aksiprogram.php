<?php

$koneksi = mysqli_connect('localhost','root','','sppujikom');

if(isset($_POST['bsubmit'])){
	global $koneksi;
$programstudi = $_POST['nama_prodi'];
$tgl=date('Y-m-d H:i:s');

$select = mysqli_query($koneksi, "SELECT * FROM program_studi WHERE nama_prodi='$programstudi'");
	$cek = mysqli_num_rows($select);
if ($cek) {
		echo '<script>alert("Program Studi sudah ada")
		document.location.href="../dataprogramstudi.php";
		</script>';
	}else{
// menginput data ke database
mysqli_query($koneksi,"insert into program_studi values('','$programstudi','$tgl')");
echo"<script>

		alert('Data Berhasil Ditambahkan!');
		document.location.href = '../dataprogramstudi.php';

	 </script>";
}
}


?>