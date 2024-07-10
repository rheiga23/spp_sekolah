<?php

$koneksi = mysqli_connect('localhost','root','','sppujikom');
//menambahkan data
if(isset($_POST['bsimpan'])){
global $koneksi;
$tahun = $_POST['tahun_ajaran'];
$tgl=date('Y-m-d H:i:s');

$select = mysqli_query($koneksi, "SELECT * FROM tahun_ajaran WHERE tahun_ajaran='$tahun'");
	$cek = mysqli_num_rows($select);
if ($cek) {
		echo '<script>alert("Tahun Ajaran sudah ada")</script>';
	}else{
// menginput data ke database

mysqli_query($koneksi,"INSERT INTO tahun_ajaran VALUES('','$tahun','$tgl')");
echo"<script>

		alert('Data Berhasil Ditambahkan!');
		document.location.href = '../datatahunajaran.php';

	 </script>";

}
}
// Hapus edit
function edittahun(){
	global $koneksi;
	$kelas_id= $_POST['id'];
	$nama_kelas = $_POST['nama_kelas'];
	$tgl =date('Y-m-d H:i:s');

	$update = mysqli_query($koneksi,"UPDATE kelas set nama_kelas='$nama_kelas', dibuat_pada='$tgl' where kelas_id='$kelas_id'");

	if($update){
		echo "<script>
		alert('Data Berhasil Di Update !');
		document.location.href='../../datakelas.php';
		</script>";
	}else{

		mysqli_query($koneksi,"UPDATE kelas SET nama_kelas='$nama_kelas',tgl='$tgl', WHERE kelas_id='$kelas_id'");
		echo "<script>
		alert('Data Gagal Di Update !');
		document.location.href='../../editkelas.php';
		</script>";
	}
}


?>