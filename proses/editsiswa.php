<?php
$koneksi = mysqli_connect('localhost','root','','sppujikom');
if(isset($_POST['ubah'])){
	global $koneksi;
	$id= $_POST['id'];
	$nama_siswa = $_POST['nama_siswa'];
	$kelas_id = $_POST['kelas_id'];
	$program_studi_id = $_POST['program_studi_id'];
	

	$update = mysqli_query($koneksi,"UPDATE siswa set nama_siswa='$nama_siswa', kelas_id='$kelas_id', program_studi_id='$program_studi_id' where id='$id'");

	if($update){
		echo "<script>
		alert('Data Berhasil Di Update !');
		document.location.href='../datasiswa.php';
		</script>";
	}else{
		mysqli_query($koneksi,"UPDATE siswa SET nama_siswa='$nama_siswa', kelas_id='$kelas_id',program_studi_id='$program_studi_id' WHERE id='$id'");
		echo "<script>
		alert('Data Gagal Di Update !');
		document.location.href='../editkelas.php';
		</script>";
	}
}
?>