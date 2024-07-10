<?php

$konekasi = mysqli_connect('localhost','root','','sppujikom');

//inputt tagihan
if(isset($_POST['kirim'])){
global $koneksi;
$siswa = $_POST['nis'];
$tahun = $_POST['tahun_ajaran'];
$bulan = $_POST['bulan'];
$keterangan = "Belum Lunas";
$nominal = "250000";
$tgl=date('Y-m-d H:i:s');

// menginput data ke database
$tambah = mysqli_query($koneksi,"INSERT INTO tagihan values('','$siswa','$tahun','$bulan','$keterangan','$nominal','$tgl')");

if ($tambah) {
	echo"<script>

		alert('Data Berhasil Ditambahkan!');
		document.location.href = '../list_tagihan.php';

	 </script>";
}else{

echo "data gagal ditambahkan";
}
}

//bayar tagihan
if(isset($_POST['bayar'])){
global $koneksi;
$tagih = $_POST['id_tagih'];
$bayar = $_POST['nominal_bayar'];
$tagihan = $_POST['nominal_tagihan'];
$met = $_POST['metode'];
$idadmin = $_POST['admin'];

$tgl=date('Y-m-d H:i:s');


// rumus untuk mengurangi nominal tagihan berdasarkan noinal yang sudah dibayarkan
$hasil = $tagihan - $bayar;

if ($bayar >=$tagihan) {
	$ket = "Lunas";
}elseif ($bayar < $tagihan) {
	
	$ket = "Belum Lunas";

}


// menginput data ke database
$tambah = mysqli_query($koneksi,"insert into pembayaran values('','$tagih','$bayar','$met','$tgl','$idadmin')");

//merubah data pada atribut nominal_bayar dan keterangan
$update	=mysqli_query($koneksi,"update tagihan set nominal_tagihan='$hasil', keterangan='$ket' where id='$tagih'");
if ($tambah) {
	echo"<script>

		alert('Pembayaran Berhasil!');
		document.location.href = 'list_tagihan.php';

	 </script>";
}else{

echo "Pembayaran Gagal!";
}
}
?>