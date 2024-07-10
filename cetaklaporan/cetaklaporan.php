<?php
// memanggil library FPDF
ob_start();
require('../pdf/fpdf.php');
include '../koneksi.php';
 
// intance object dan memberikan pengaturan halaman PDF
$pdf=new FPDF('L','mm','A4');
$pdf->AddPage();
 
$pdf->SetFont('Times','B',13);
$pdf->Cell(250,10,'LAPORAN PEMBAYARAN SPP SISWA',0,0,'C');
 
$pdf->Cell(10,15,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(10,7,'NO',1,0,'C');
$pdf->Cell(20,7,'ID TAGIHAN' ,1,0,'C');
$pdf->Cell(25,7,'NIS',1,0,'C');
$pdf->Cell(55,7,'NAMA SISWA',1,0,'C');
$pdf->Cell(25,7,'TAHUN AJARAN',1,0,'C');
$pdf->Cell(32,7,'SISA TAGIHAN',1,0,'C');
$pdf->Cell(25,7,'KETERANGAN',1,0,'C');
$pdf->Cell(25,7,'BULAN',1,0,'C');
$pdf->Cell(32,7,'TANGGAL',1,0,'C');
// $pdf->Cell(32,7,'ADMIN',1,0,'C');
 
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Times','',10);
$no=1;
// $query = "SELECT pembayaran.id, pembayaran.nominal_bayar, pembayaran.metode_pembayaran, pembayaran.tanggal_bayar, pembayaran.admin_id, tagihan.bulan,tagihan.keterangan, tagihan.siswa_id,tagihan.nominal_tagihan, admin.nama, siswa.nama_siswa,siswa.nis
//      FROM pembayaran 
//      INNER JOIN tagihan ON pembayaran.tagihan_id = tagihan.id INNER JOIN siswa ON tagihan.siswa_id = siswa.siswa_id
//      INNER JOIN admin ON pembayaran.admin_id = admin.id";
$query = mysqli_query($koneksi,"SELECT * FROM tagihan 
     INNER JOIN siswa ON tagihan.siswa_id = siswa.id 
     INNER JOIN tahun_ajaran ON tagihan.tahun_ajaran_id = tahun_ajaran.id");
while($d = mysqli_fetch_array($query)){
  $pdf->Cell(10,6, $no++,1,0,'C');
  $pdf->Cell(20,6, $d['id_tagihan'],1,0,'C');
  $pdf->Cell(25,6, $d['nis'],1,0,'C');  
  $pdf->Cell(55,6, $d['nama_siswa'],1,0,'C');
  $pdf->Cell(25,6, $d['tahun_ajaran'],1,0,'C');
  $pdf->Cell(32,6, 'Rp. '.number_format($d['nominal_tagihan']),1,0,'C');
  $pdf->Cell(25,6, $d['keterangan'],1,0,'C');
  $pdf->Cell(25,6, $d['bulan'],1,0,'C');
  $pdf->Cell(32,6, $d['dibuat_pada'],1,1,'C');
  // $pdf->Cell(25,6, $d['admin'],1,1,'C');
}

$pdf->Output();
 ob_end_flush();
?>