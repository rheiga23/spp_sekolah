<?php

$koneksi = mysqli_connect('localhost','root','','sppujikom');

if(isset($_POST['btambah'])){
global $koneksi;
date_default_timezone_set('Asia/Jakarta');
$nama_kelas = $_POST['nama_kelas'];
$tgl=date('Y-m-d H:i:s');

$select = mysqli_query($koneksi, "SELECT * FROM kelas WHERE nama_kelas='$nama_kelas'");
	$cek = mysqli_num_rows($select);
if ($cek) {
		echo '<script>alert("Kelas sudah ada")
        document.location.href="../datakelas.php";
        </script>';
	}else{

// menginput data ke database
$tambah = mysqli_query($koneksi,"insert into kelas values('','$nama_kelas','$tgl')");

echo"<script>

		alert('Data Berhasil Ditambahkan!');
		document.location.href = '../datakelas.php';

	 </script>";
}

}

//edit
if(isset($_POST['bedit'])){
	global $koneksi;
	$kelas_id= $_POST['id'];
	$nama_kelas = $_POST['nama_kelas'];
	$tgl =date('Y-m-d H:i:s');

	$update = mysqli_query($koneksi,"UPDATE kelas set nama_kelas='$nama_kelas', dibuat_pada='$tgl' where kelas_id='$kelas_id'");

	if($update){
		echo "<script>
		alert('Data Berhasil Di Update !');
		document.location.href='../datakelas.php';
		</script>";
	}else{

		mysqli_query($koneksi,"UPDATE kelas SET nama_kelas='$nama_kelas',tgl='$tgl', WHERE kelas_id='$kelas_id'");
		echo "<script>
		alert('Data Gagal Di Update !');
		document.location.href='../editkelas.php';
		</script>";
	}
}
 
?>